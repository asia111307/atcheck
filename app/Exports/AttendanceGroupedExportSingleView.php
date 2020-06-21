<?php

namespace App\Exports;

use App\Subject;
use App\Classes;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithTitle;

class AttendanceGroupedExportSingleView implements FromView, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $attendances;
    private $groupBy;
    private $groupedValue;

    public function __construct($attendances, $groupBy, $groupedValue)
    {
        $this->attendances = $attendances;
        $this->groupBy = $groupBy;
        $this->groupedValue = $groupedValue;
    }

    public function view(): View
    {
        return view('user.attendances_table', ['attendances_list' => $this->attendances, 'export' => 1]);
    }

    public function title(): string
    {
        if($this->groupBy == 'classes_id') {

            $subject = Subject::findOrFail(Classes::find($this->groupedValue)->subject_id)->name;
            $date = Classes::findOrFail($this->groupedValue)->date;

            $this->groupedValue = "{$date} {$subject}";
        } else if($this->groupBy == 'seat_number') {
            $this->groupedValue = "{$this->groupedValue}";
        }
        return substr(str_replace(":", "-", "{$this->groupedValue}"), 0, 30);
    }
}
