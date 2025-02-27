<?php

namespace App\Services;

use App\Exports\DailyTasksExcelExport;
use App\Repositories\ExcelRepository;
use Maatwebsite\Excel\Facades\Excel;

class ExcelService {

    protected $excelRepository;

    public function __construct(ExcelRepository $excelRepository)
    {
        $this->excelRepository = $excelRepository;
    }
    public function exportDailyTasks()
    {
        $fileName = 'daily_tasks_' . now()->format('Y-m-d_H-i') . '.xlsx';
        return Excel::download(new DailyTasksExcelExport($this->excelRepository), $fileName);
    }
}
