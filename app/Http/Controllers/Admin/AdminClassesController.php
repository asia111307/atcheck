<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Subject;
use App\Classes;

class AdminClassesController extends Controller
{
    public function index()
    {
        $classes = Classes::all();
        $subjects = Subject::all();
        return view('admin.admin_classes', ['classes' => $classes, 'subjects' => $subjects]);
    }

    public function add_classes(Request $request)
    {
        $subject_id = $request->input('subject_id');
        $date = $request->input('date');
        Classes::create([
            'subject_id' => $subject_id,
            'date' => $date
        ]);
        return redirect(route('admin_classes'));
    }

    public function delete_classes($classes_id)
    {
        Classes::find($classes_id)->delete();
        return redirect(route('admin_classes'));
    }

    public function edit_classes($classes_id)
    {
        Classes::find($classes_id);
        return redirect(route('admin_classes'));
    }
}
