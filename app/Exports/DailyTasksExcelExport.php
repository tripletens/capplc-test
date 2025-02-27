<?php

namespace App\Exports;

use App\Models\Task;
use App\Repositories\ExcelRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DailyTasksExcelExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $excelRepository;
    public function __construct(ExcelRepository $excelRepository)
    {
        $this->excelRepository = $excelRepository;
    }
    /**
     * Return data to export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return dd(Carbon::today());
        return $this->excelRepository->exportDailyTasks();
    }

    /**
     * Define column headings.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Date',
            'Employee Name',
            'Department',
            'Task Details',
            'Hours Worked',
        ];
    }
}
