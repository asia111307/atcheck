<?php

namespace App\Http\Controllers\User;

use App\Attendance;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserCache;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Subject;
use App\Classes;
use App\Room;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserClassesController extends Controller {

    protected function validator(array $data)
    {
        $messages = [
            'subject_id.required' => 'Wskazanie przedmiotu jest wymagane.',
            'subject_id.exists' => 'Wybrany przedmiot jest niepoprawny.',
            'date.required' => 'Data jest wymagana.',
            'date.date' => 'Niepoprawny format daty.',
            'mode.in' => 'Tryb zajęć jest niepoprawny.'
        ];

        $rules = [
            'subject_id' => ['required', 'exists:subjects,id'],
            'date' => ['required', 'date'],
            'mode' => Rule::in([null, 'test', 'quick'])
        ];
        return Validator::make($data, $rules, $messages);
    }

    protected function student_validator(array $data)
    {
        $messages = [
            'student_id_number.required' => 'Numer indeksu jest wymagany.',
            'student_id_number.numeric' => 'Numer indeksu nie jest liczbą.',
            'student_name.required' => 'Imię jest wymagane.',
            'student_surname.required' => 'Nazwisko jest wymagane.',
        ];

        $rules = [
            'student_id_number' => ['required', 'numeric'],
            'student_name' => ['required'],
            'student_surname' => ['required'],
        ];
        return Validator::make($data, $rules, $messages);
    }

    public function index($groupBy = 'subject_id') {
        $user_id = Auth::id();
        if(!$user_id) {
            abort(401);
        }
        $subjects = Subject::where('user_id', $user_id)->get();
        $subjects_ids = $subjects->pluck('id')->toArray();
        $classes = Classes::whereIn('subject_id', $subjects_ids)->orderBy('created_at', 'DESC')->get();
        foreach ($classes as $classes_item) {
            $current_date = date('Y-m-d H:i:s');
            $classes_date = $classes_item->created_at;
            $hours_difference = checkHoursDifference($classes_date, $current_date);
            if ($hours_difference > 1.5) {
                $classes_item->classes_code = null;
                $classes_item->save();
                $classes_item->refresh();
            }
        }
        $classes_grouped = $classes->groupBy($groupBy);
        $defaultDate = date("Y-m-d");
        return view('user.user_classes', ['classes' => $classes, 'classes_grouped' => $classes_grouped, 'subjects' => $subjects, 'grouped_by' => $groupBy, 'defaultDate' => $defaultDate]);
    }

    public function add_classes(Request $request) {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $subject_id = $request->input('subject_id');
        $date = $request->input('date');
        $mode = $request->input('mode');
        $classes_id = Classes::create([
            'subject_id' => $subject_id,
            'date' => $date,
            'mode' => $mode
        ])->id;
        return redirect(route('user_start_classes', ['classes_id' => $classes_id]));
    }

    public function delete_classes($classes_id) {
        try {
            Classes::findOrFail($classes_id)->delete();
            return redirect()->back();
        } catch(ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(['Takie zajęcia nie istniejeą w bazie danych, zatem nie można ich usunąć.']);
        }
    }

    public function edit_classes($classes_id) {
        Classes::findOrFail($classes_id);
        return redirect()->back();
    }

    public function start_classes($classes_id) {
        try {
            $classes = Classes::findOrFail($classes_id);
            $classes_code = $classes->classes_code;
            if (!$classes_code) {
                $classes_code = generateRandomString(10);
                $classes->classes_code = $classes_code;
                $classes->save();
                $classes->refresh();
            }
            return view('map.start_map', ['classes_code' => $classes_code, 'classes' => $classes]);
        } catch(ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(['Takie zajęcia nie istnieją w bazie danych, zatem nie można ich rozpocząć.']);
        }
    }

    public function start_classes_verified(Request $request) {
        $validator = $this->student_validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $student_id_number = $request->input('student_id_number');
        $student_name = $request->input('student_name');
        $student_surname = $request->input('student_surname');
        try {
            $classes = Classes::findOrFail($request->get('classes_id'));
        } catch(ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(['Takie zajęcia nie istnieją w bazie danych, zatem nie można ich rozpocząć.']);
        }
        try {
            $subject = Subject::findOrFail($classes->subject_id);
        } catch(ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(['Taki przedmiot nie istnieje w bazie danych.']);
        }
        try {
            $room_capacity = Room::findOrFail($subject->room_id)->capacity;
        } catch(ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(['Taka sala nie istnieje w bazie danych.']);
        }
        $attendances = Attendance::where('classes_id', $classes->id)->get();
        $student_ids = $attendances->pluck('student_id_number')->toArray();
        $seat_numbers = $attendances->pluck('seat_number')->toArray();

        if (in_array($student_id_number, $student_ids)) { // if student attendance record already exists
            $student_seat_number = Attendance::where('student_id_number', $student_id_number)->first()->seat_number;
            $warning = 'Ten numer indeksu został już wcześniej zapisany na te zajęcia.';
            return view('map.summary_map', ['student_name' => $student_name, 'student_surname' => $student_surname, 'seat_number' => $student_seat_number, 'student_id_number' => $student_id_number, 'classes_id' => $classes->id, 'mode' => $classes->mode, 'warning' => $warning]);
        } else {
            if (count($seat_numbers) >= $room_capacity) { // if there are no more free seats in room, add student without assigning seat number (regardless of the classes mode)
                Attendance::create([
                    'classes_id' => $classes->id,
                    'student_id_number' => $student_id_number,
                    'student_name' => $student_name,
                    'student_surname' => $student_surname,
                    'seat_number' => null
                ]);
                $warning = "Zostałeś zapisany na listę obecności, ale bez przyznanego miejsca.";
                return view('map.summary_map', ['student_name' => $student_name, 'student_surname' => $student_surname, 'seat_number' => null, 'student_id_number' => $student_id_number, 'classes_id' => $classes->id, 'mode' => $classes->mode, 'warning' => $warning]);
            } else {
                if ($classes->mode == 'quick') {
                    Attendance::create([
                        'classes_id' => $classes->id,
                        'student_id_number' => $student_id_number,
                        'student_name' => $student_name,
                        'student_surname' => $student_surname,
                        'seat_number' => null
                    ]);
                    return view('map.summary_map', ['student_name' => $student_name, 'student_surname' => $student_surname, 'seat_number' => null, 'student_id_number' => $student_id_number, 'classes_id' => $classes->id, 'mode' => $classes->mode, 'warning' => null]);
                } else {
                    // prepare seat map
                    try {
                        $room_arrangement = Room::findOrFail($subject->room_id)->arrangement;
                    } catch(ModelNotFoundException $exception) {
                        return redirect()->back()->withErrors(['Taka sala nie istnieje w bazie danych.']);
                    }
                    if (!$room_arrangement) {
                        $room_arrangement = Room::where('name', 'Inna sala')->first()->arrangement;
                    }
                    $room_rows = count(explode("++", $room_arrangement));
                    if ($room_rows > 4) {  //max 4 rows on one page
                        $multi_parts = true;
                        $parts_number = ceil($room_rows / 4);
                    } else {
                        $multi_parts = false;
                        $parts_number = 1;
                    }

                    if ($classes->mode == 'test') {
                        $random_seat = rand(1, $room_capacity);
                        while (in_array($random_seat, $seat_numbers)) {
                            $random_seat = rand(1, $room_capacity);
                        }
                        return view('map.seat_map', ['student_name' => $student_name, 'student_surname' => $student_surname, 'seat_number' => $random_seat, 'student_id_number' => $student_id_number, 'classes_id' => $classes->id, 'seat_numbers' => $seat_numbers, 'room_arrangement' => $room_arrangement, 'multi_parts' => $multi_parts, 'parts_number' => $parts_number, 'mode' => 'test', 'random_seat' => $random_seat]);
                    } else {
                        return view('map.seat_map', ['student_name' => $student_name, 'student_surname' => $student_surname, 'student_id_number' => $student_id_number, 'classes_id' => $classes->id, 'seat_numbers' => $seat_numbers, 'room_arrangement' => $room_arrangement, 'multi_parts' => $multi_parts, 'parts_number' => $parts_number, 'mode' => null]);
                    }
                }
            }
        }

    }

    public function save_classes_data(Request $request) {
        $classes_id = $request->input('classes_id');
        $student_id_number = $request->input('student_id_number');
        $student_name = $request->input('student_name');
        $student_surname = $request->input('student_surname');
        $seat_number = $request->input('seat_number');
        try {
            $classes = Classes::findOrFail($request->get('classes_id'));
        } catch(ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(['Takie zajęcia nie istnieją w bazie danych.']);
        }
        $attendances = Attendance::where('classes_id', $classes->id)->get();
        $student_ids = $attendances->pluck('student_id_number')->toArray();

        if (in_array($student_id_number, $student_ids)) { // if student attendance record already exists
            $student_seat_number = Attendance::where('student_id_number', $student_id_number)->first()->seat_number;
            $warning = 'Ten numer indeksu został już wcześniej zapisany na te zajęcia.';
            return view('map.summary_map', ['student_name' => $student_name, 'student_surname' => $student_surname, 'seat_number' => $student_seat_number, 'student_id_number' => $student_id_number, 'classes_id' => $classes->id, 'mode' => $classes->mode, 'warning' => $warning]);
        } else {
            Attendance::create([
                'classes_id' => $classes_id,
                'student_id_number' => $student_id_number,
                'student_name' => $student_name,
                'student_surname' => $student_surname,
                'seat_number' => $seat_number
            ]);
            return view('map.summary_map', ['student_name' => $student_name, 'student_surname' => $student_surname, 'seat_number' => $seat_number, 'student_id_number' => $student_id_number, 'classes_id' => $classes_id, 'mode' => null, 'warning' => null]);
        }
    }

    public function preview_classes($classes_id, $orderBy = 'student_surname', $orderDirection = 'ASC') {
        if (!$classes_id == 0) {
            try {
                $classes = Classes::findOrFail($classes_id);
            } catch(ModelNotFoundException $exception) {
                return redirect()->back()->withErrors(['Takie zajęcia nie istnieją w bazie danych.']);
            }
            $attendances = Attendance::where('classes_id', $classes->id)->orderBy($orderBy, $orderDirection)->get();
            $seat_numbers = $attendances->pluck('seat_number')->toArray();
            try {
                $subject = Subject::findOrFail($classes->subject_id);
            } catch(ModelNotFoundException $exception) {
                return redirect()->back()->withErrors(['Taki przedmiot nie istnieje w bazie danych.']);
            }
            try {
                $room_arrangement = Room::findOrFail($subject->room_id)->arrangement;
            } catch(ModelNotFoundException $exception) {
                return redirect()->back()->withErrors(['Taka sala nie istnieje w bazie danych.']);
            }
            if (!$room_arrangement) {
                $room_arrangement = Room::where('name', 'Inna sala')->first()->arrangement;
            }
            $room_rows = count(explode("++", $room_arrangement));
            if ($room_rows > 4) {  //max 4 rows on one page
                $multi_parts = true;
                $parts_number = ceil($room_rows / 4);
            } else {
                $multi_parts = false;
            }
            return view('user.user_preview_classes', ['classes_id' => $classes_id, 'room_arrangement' => $room_arrangement, 'attendances' => $attendances, 'seat_numbers' => $seat_numbers, 'orderBy' => $orderBy, 'orderDirection' => $orderDirection, 'multi_parts' => $multi_parts, 'parts_number' => $parts_number]);
        }
        return redirect()->back();
    }
}
