<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // view all tasks
    public function view(User $user){
        return $user->hasRole(['employee','admin','manager']);
    }

    // create task
    public function create(User $user)
    {
        return $user->hasRole(['admin', 'employee']);
    }

    // search task
    public function search(User $user){
        return $user->hasRole(['employee','admin','manager']);
    }

    // update task
    public function update(User $user, Task $task)
    {
        // Only admins, or the task creator within 24 hours, can edit
        return $user->hasRole('admin') || ($task->employee_id === $user->id && now()->diffInHours($task->created_at) <= 24);

        // return $user->id == $task->employee_id;
    }

    // delete task
    public function delete(User $user, Task $task)
    {
        return $user->hasRole('admin')|| ($task->employee_id === $user->id);
    }

    // export daily tasks
    public function exportDailyTasks(User $user){
        return $user->hasRole(['employee','admin','manager']);
    }

    // approval
    public function approveTask(User $user){
        return $user->hasRole('manager');
    }
}
