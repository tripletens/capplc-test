<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class PdfRepository {
    public function exportDailyTasks() {
        return Task::whereDate('tasks.created_at', Carbon::today())
            ->join('departments', 'tasks.department_id', '=', 'departments.id')
            ->whereNull('tasks.deleted_at')
            ->select('tasks.date', 'tasks.employee_name', 'departments.name as department_name', 'tasks.task_details', 'tasks.hours_worked')
            ->get();
    }

    public function fetchDepartmentHeads(){
        // dd(User::where('role','manager')->get()->toArray());
        return User::where('role','manager')->select('id','name','email')->get();
    }
}
