<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use App\Services\UserService;

class DashboardController extends Controller
{
    //

    protected $userService, $taskService;

    public function __construct(TaskService $taskService, UserService $userService)
    {
        $this->userService = $userService;
        $this->taskService = $taskService;
    }

    public function dashboard()
    {
        $employeesCount = $this->userService->fetchEmployeesCount();
        $tasksCount = $this->taskService->numberOfTasks();
        $approvedTasksCount = $this->taskService->numberOfApprovedTasks();
        $unapprovedTasksCount = $this->taskService->numberOfUnapprovedTasks();

        return view('dashboard', compact('employeesCount','tasksCount','approvedTasksCount','unapprovedTasksCount'));
    }
}
