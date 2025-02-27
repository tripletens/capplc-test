<?php 

namespace App\Console\Commands;

use App\Exports\DailyTasksPdfExport; 
use App\Mail\DailyReportMail; 
use App\Repositories\PdfRepository; 
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail; 
use Carbon\Carbon;
use Maatwebsite\Excel\Excel as Excel;

class SendDailyReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-daily-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily task reports to department heads i.e managers';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pdfRepository = app(PdfRepository::class); // Manually resolve the dependency

        // Generate the report
        $reportFileName = 'daily_tasks_' . Carbon::now()->format('Y-m-d') . '.xlsx';

        // Store the report using an instance of Excel
        $excel = app()->make('Maatwebsite\Excel\Excel'); 
        $excel->store(new DailyTasksPdfExport($pdfRepository), $reportFileName); 

        // Fetch department heads' email addresses
        $departmentHeads = $pdfRepository->fetchDepartmentHeads();

        // dd($departmentHeads);

        // Send the email with the report attached
        foreach ($departmentHeads as $key => $head) {
            // dd($head->email);
            Mail::to($head->email)->send(new DailyReportMail($reportFileName));
        }

        $this->info('Daily reports sent to department heads.');
    }
}
