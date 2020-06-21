<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Classes;
use App\Attendance;

class AdminAttendancesController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();
        $classes = Classes::all();
        return view('admin.admin_attendances', ['attendances' => $attendances, 'classes' => $classes]);
    }

    public function add_attendance(Request $request)
    {
        $classes_id = $request->input('classes_id');
        $student_id_number = $request->input('student_id');
        $student_name = $request->input('student_name');
        $student_surname = $request->input('student_surname');
        $seat_number = $request->input('seat_number');
        Attendance::create([
            'classes_id' => $classes_id,
            'student_id_number' => $student_id_number,
            'student_name' => $student_name,
            'student_surname' => $student_surname,
            'seat_number' => $seat_number,
        ]);
        return redirect(route('admin_attendances'));
    }

    public function delete_attendance($attendance_id)
    {
        Attendance::find($attendance_id)->delete();
        return redirect(route('admin_attendances'));
    }

    public function edit_attendance($attendance_id)
    {
        Attendance::find($attendance_id);
        return redirect(route('admin_attendances'));
    }
}
