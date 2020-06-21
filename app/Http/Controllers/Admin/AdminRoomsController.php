<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Subject;
use App\Room;
use App\Classes;
use App\Attendance;

class AdminRoomsController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('admin.admin_rooms', ['rooms' => $rooms]);
    }

    public function add_room(Request $request)
    {
        $name = $request->input('name');
        $capacity = $request->input('capacity');
        $arrangement = $request->input('arrangement');
        Room::create([
            'name' => $name,
            'capacity' => $capacity,
            'arrangement' => $arrangement
        ]);
        return redirect(route('admin_rooms'));
    }

    public function delete_room($room_id)
    {
        Room::find($room_id)->delete();
        return redirect(route('admin_rooms'));
    }

    public function edit_room($room_id)
    {
        Room::find($room_id);
        return redirect(route('admin_rooms'));
    }
}
