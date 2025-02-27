<?php

use App\Console\Commands\SendDailyReports;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(SendDailyReports::class)->dailyAt('16:00');

// Schedule::command(SendDailyReports::class)->everySecond();
