<?php

namespace App\Http\Controllers;

use App\Services\ExcelService;
use Illuminate\Http\Request;

class ExportExcelController extends Controller
{
    // add the service variable 
    protected $excelService;

    public function __construct(ExcelService $excelService)
    {
        $this->excelService = $excelService;
    }

    public function exportDailyTasks(){
        return $this->excelService->exportDailyTasks();
    }
}
