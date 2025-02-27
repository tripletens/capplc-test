<?php

namespace App\Repositories;

use App\Interfaces\ExcelRepositoryInterface;
use App\Models\Task;
use Carbon\Carbon;

class ExcelRepository implements ExcelRepositoryInterface {
    public function exportDailyTasks(){
        return Task::whereDate('tasks.created_at', Carbon::today())
            ->join('departments', 'tasks.department_id', '=', 'departments.id')
            ->whereNull('tasks.deleted_at')
            ->select('tasks.date', 'tasks.employee_name', 'departments.name as department_name', 'tasks.task_details', 'tasks.hours_worked')
            ->get();
    }
}
