<?php

namespace App\Exports;

use App\Attendance;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class AttendanceExportView implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $classes_id;

    public function __construct($classes_id)
    {
        $this->classes_id = $classes_id;
    }

    public function view(): View
    {
        $attendances = Attendance::where('classes_id', $this->classes_id)->get();
        return view('user.attendances_table_preview', ['attendances' => $attendances, 'export' => 1]);

    }
}
