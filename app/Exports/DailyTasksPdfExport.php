<?php
namespace App\Exports;

use App\Models\Task;
use App\Repositories\PdfRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class DailyTasksPdfExport implements FromView
{
    protected $pdfRepository;
    protected $title;

    public function __construct(PdfRepository $pdfRepository)
    {
        $this->pdfRepository = $pdfRepository;
        $this->title = 'Daily Task Report - ' . now()->format('d-M-Y');
    }

    public function view(): View
    {
        $tasks = $this->pdfRepository->exportDailyTasks();
        $title = $this->title;

        return view('exports.daily_tasks_pdf', compact('tasks', 'title'));
    }
}
