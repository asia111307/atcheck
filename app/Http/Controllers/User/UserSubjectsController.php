<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Subject;
use App\Room;
use Illuminate\Validation\Rule;

class UserSubjectsController extends Controller
{
    protected function validator(array $data)
    {
        $messages = [
            'name.required' => 'Nazwa przedmiotu jest wymagana.',
            'name.unique' => 'Podana nazwa przedmiotu już istnieje w systemie.',
            'weekday.in' => 'Dzień tygodnia jest niepoprawny.',
            'time.date_format' => 'Podana godzina jest nieprawidłowa.',
            'room_id.required' => 'Sala jest wymagana.',
            'room_id.exists' => 'Niepoprawny numer sali.'
        ];

        $rules = [
            'name' => ['required', 'unique:subjects,name'],
            'weekday' => Rule::in([null, 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela']),
            'time' => ['date_format:H:i'],
            'room_id' => ['required', 'exists:rooms,id'],
        ];
        return Validator::make($data, $rules, $messages);
    }

    protected function edited_validator(array $data)
    {
        $messages = [
            'name_e.required' => 'Nazwa przedmiotu jest wymagana.',
            'name_e.unique' => 'Podana nazwa przedmiotu już istnieje w systemie.',
            'weekday_e.in' => 'Dzień tygodnia jest niepoprawny.',
            'time_e.date_format' => 'Podana godzina jest nieprawidłowa.',
            'room_id_e.required' => 'Sala jest wymagana.',
            'room_id_e.exists' => 'Niepoprawny numer sali.'
        ];

        $rules = [
            'name_e' => ['sometimes', 'required', 'unique:subjects,name'],
            'weekday_e' => Rule::in([null, 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela']),
            'time_e' => ['date_format:H:i'],
            'room_id_e' => ['required', 'exists:rooms,id'],
            'subject_id' => ['sometimes']
        ];
        return Validator::make($data, $rules, $messages);
    }

    public function index($groupBy = 'weekday') {
        $user_id = Auth::id();
        if(!$user_id) {
            abort(401);
        }
        $subjects = Subject::where('user_id', $user_id)->orderBy('name','ASC')->get();
        $subjects_grouped = $subjects->groupBy($groupBy);
        $rooms = Room::all();
        $weekdays = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela'];
        $defaultTime = date("H:i");
        if(date('w')-1 < 0 ) {
            $defaultWeekday = $weekdays[6];
        } else {
            $defaultWeekday = $weekdays[date('w') - 1];
        }
        return view('user.user_subjects', ['subjects' => $subjects, 'weekdays' => $weekdays, 'subjects_grouped' => $subjects_grouped, 'grouped_by' => $groupBy, 'defaultTime' => $defaultTime, 'defaultWeekday' => $defaultWeekday, 'rooms' => $rooms]);
    }

    public function add_subject(Request $request) {

        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $name = $request->input('name');
        $weekday = $request->input('weekday');
        $time = $request->input('time');
        $room_id = $request->input('room_id');
        $user_id = Auth::id();
        Subject::create([
            'name' => $name,
            'weekday'=> $weekday,
            'time' => $time,
            'room_id' => $room_id,
            'user_id' => $user_id
        ]);
        return redirect()->back();
    }

    public function delete_subject($subject_id)
    {
        try {
            Subject::findOrFail($subject_id)->delete();
            return redirect()->back();
        } catch(ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(['Taki przedmiot nie istnieje w bazie danych, zatem nie można go usunąć.']);
        }
    }

    public function edit_subject(Request $request)
    {
        $subject_id = $request->input('subject_id');
        try {
            $subject = Subject::findOrFail($subject_id);
            if ($request->input('name_e') == $subject->name) {
                $validator = $this->edited_validator($request->except(['name_e']));
            } else {
                $validator = $this->edited_validator($request->all());
            }
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('subject_id_redirected', $subject_id);
            }
            $subject->name = $request->input('name_e');
            $subject->weekday = $request->input('weekday_e');
            $subject->time = $request->input('time_e');
            $subject->room_id = $request->input('room_id_e');
            $subject->save();
            $subject->refresh();
            return redirect()->back();
        } catch(ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(['Taki przedmiot nie istnieje w bazie danych, zatem nie można go edytować.']);
        }

}
}
