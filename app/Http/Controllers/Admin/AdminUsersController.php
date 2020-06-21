<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Subject;
use App\Room;
use App\Classes;
use App\Attendance;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.admin_users', ['users' => $users]);
    }

    public function add_user(Request $request)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');
        $id_number = $request->input('id_number');
        return redirect(route('admin_users'));
    }

    public function delete_user($user_id)
    {
        User::find($user_id)->delete();
        return redirect(route('admin_users'));
    }

    public function edit_user($user_id)
    {
        User::find($user_id);
        return redirect(route('admin_users'));
    }
}
