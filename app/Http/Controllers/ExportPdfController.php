<?php

namespace App\Http\Controllers;

use App\Services\PdfService;
use Illuminate\Http\Request;

class ExportPdfController extends Controller
{
    //
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

     /**
     * Export daily tasks to PDF.
     */
    public function exportDailyTasks()
    {
        return $this->pdfService->exportDailyTasksToPdf();
    }
}
