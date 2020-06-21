<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\AttendanceExportView;
use App\Exports\AttendanceGroupedExportView;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

use App\Subject;
use App\Classes;
use App\Attendance;

class UserAttendancesController extends Controller
{

    protected function validator(array $data)
    {
        $messages = [
            'classes_id.required' => 'Wskazanie zajęć jest wymagane.',
            'classes_id.exists' => 'Niepoprawne zajęcia.',
            'student_id.required' => 'Numer indeksu jest wymagany.',
            'student_id.numeric' => 'Numer indeksu nie jest liczbą.',
            'student_name.required' => 'Imię jest wymagane.',
            'student_surname.required' => 'Nazwisko jest wymagane.',
        ];

        $rules = [
            'classes_id' => ['required', 'exists:classes,id'],
            'student_id' => ['required', 'numeric'],
            'student_name' => ['required'],
            'student_surname' => ['required'],
        ];
        return Validator::make($data, $rules, $messages);
    }

    public function index($groupBy='classes_id')
    {
        $user_id = Auth::id();
        if(!$user_id) {
            abort(401);
        }
        $subjects = Subject::where('user_id', $user_id)->get();
        $subjects_ids = $subjects->pluck('id')->toArray();
        $classes = Classes::whereIn('subject_id', $subjects_ids)->orderBy('created_at','DESC')->get();
        $classes_ids = $classes->pluck('id')->toArray();
        $attendances = Attendance::whereIn('classes_id', $classes_ids)->get();
        $attendances_grouped = $attendances->groupBy($groupBy);
        return view('user.user_attendances', ['attendances' => $attendances, 'attendances_grouped' => $attendances_grouped, 'classes' => $classes, 'grouped_by' => $groupBy]);
    }

    public function add_attendance(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $classes_id = $request->input('classes_id');
        $student_id_number = $request->input('student_id');
        $student_name = $request->input('student_name');
        $student_surname = $request->input('student_surname');
        $seat_number = $request->input('seat_number');
        $note = $request->input('note');
        $attendances = Attendance::where('classes_id', $classes_id)->get();
        $student_ids = $attendances->pluck('student_id_number')->toArray();

        if (in_array($student_id_number, $student_ids)) { // if student attendance record already exists
            return redirect()->back()
                ->withErrors(['Ten numer indeksu został już wcześniej zapisany na te zajęcia.']);
        }
        Attendance::create([
        'classes_id' => $classes_id,
        'student_id_number' => $student_id_number,
        'student_name' => $student_name,
        'student_surname' => $student_surname,
        'seat_number' => $seat_number,
        'notes' => $note
        ]);
        return redirect()->back();
    }

    public function delete_attendance($attendance_id)
    {
        try {
            Attendance::findOrFail($attendance_id)->delete();
            return redirect()->back();
        } catch(ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(['Taki wpis obecności nie istnieje w bazie danych, zatem nie można go usunąć.']);
        }
    }

    public function edit_attendance($attendance_id)
    {
        Attendance::findOrFail($attendance_id);
        return redirect()->back();
    }

    public function export($classes_id)
    {
        try {
            $classes_date = Classes::findOrFail($classes_id)->date;
            return Excel::download(new AttendanceExportView($classes_id), "classes-attendance-{$classes_date}.xlsx");
        } catch(ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(['Takie zajęcia nie istnieją w bazie danych, zatem nie można wyeksportować obecności.']);
        }

    }

    public function export_grouped($groupBy)
    {
        $today_date = date('Y-m-d');
        $groupByLabel = str_replace("_", "-", $groupBy);
        if($groupBy == 'classes_id') {
            $groupByLabel = 'classes-name';
        }
        if($today_date & $groupByLabel){
            return Excel::download(new AttendanceGroupedExportView($groupBy), "all-attendance-grouped-by-{$groupByLabel}-{$today_date}.xlsx");
        };
        return redirect()->back();
    }

    public function add_attendance_note(Request $request)
    {
        $attendance_id = $request->input('attendance_id');
        $note = $request->input('note_content');
        try {
            $attendance = Attendance::findOrFail($attendance_id);
            $attendance->notes = $note;
            $attendance->save();
            $attendance->refresh();
            return redirect()->back();
        } catch(ModelNotFoundException $exception) {
            return redirect()->back()->withErrors(['Taki wpis obecności nie istnieje w bazie danych, zatem nie można dodaź do niego notatki.']);
        }
    }
}
