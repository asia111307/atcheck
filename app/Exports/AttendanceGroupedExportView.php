<?php

namespace App\Exports;

use App\Attendance;
use App\Subject;
use App\Classes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AttendanceGroupedExportView implements WithMultipleSheets
{
    /**
     * @return \Illuminate\Support\Collection
     */

    use Exportable;

    private $groupBy;

    public function __construct($groupBy)
    {
        $this->groupBy = $groupBy;
    }

    public function sheets(): array
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
        $attendances_grouped = $attendances->groupBy($this->groupBy);

        foreach ($attendances_grouped as $attendances_group_name => $attendances_list) {
            $sheets[] = new AttendanceGroupedExportSingleView($attendances_list, $this->groupBy, $attendances_group_name);
        }
        return $sheets;
    }
}
