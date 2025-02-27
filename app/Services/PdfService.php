<?php

namespace App\Services;

use App\Exports\DailyTasksPdfExport;
use App\Repositories\PdfRepository;
use Maatwebsite\Excel\Facades\Excel;

class PdfService {
    protected $pdfRepository;
    
    public function __construct(PdfRepository $pdfRepository)
    {
        $this->pdfRepository = $pdfRepository;
    }

    public function exportDailyTasksToPdf()
    {
        return Excel::download(new DailyTasksPdfExport($this->pdfRepository), 'daily_tasks_' . now()->format('Y-m-d_H-i') . '.pdf', \Maatwebsite\Excel\Excel::DOMPDF, [
            'orientation' => 'portrait', 
            'page_size' => 'A4', 
            'margin_top' => 10,
            'margin_right' => 10,
            'margin_bottom' => 10,
            'margin_left' => 10,
        ]);
    }
}
