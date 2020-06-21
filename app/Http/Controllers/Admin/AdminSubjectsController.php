<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Subject;
use App\Room;


class AdminSubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        $users = User::all();
//        $rooms = Room::all();
        $weekdays = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela'];
//        $types = ['Lecture', 'Excercises', 'Labs', 'Other'];
        return view('admin.admin_subjects', ['subjects' => $subjects, 'users' => $users, 'weekdays' => $weekdays]);
    }

    public function add_subject(Request $request)
    {
        $name = $request->input('name');
//        $type = $request->input('type');
        $weekday = $request->input('weekday');
        $time = $request->input('time');
//        $room_id = $request->input('room_id');
        $user_id = $request->input('user_id');
        Subject::create([
            'name' => $name,
//            'type' => $type,
            'weekday'=> $weekday,
            'time' => $time,
//            'room_id' => $room_id,
            'user_id' => $user_id
        ]);
        return redirect(route('admin_subjects'));
    }

    public function delete_subject($subject_id)
    {
        Subject::find($subject_id)->delete();
        return redirect(route('admin_subjects'));
    }

    public function edit_subject($subject_id)
    {
        Subject::find($subject_id);
        return redirect(route('admin_subjects'));
    }
}
