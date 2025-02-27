<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface{

    public function getAll()
    {
        return Task::with('department')->orderBy('id', 'desc')->get();
    }

    public function create(array $data){
        return Task::create($data);
    }

    public function update(array $data, int $id){
        $task = Task::findorfail($id);

        return $task->update($data);
    }

    public function delete(int $id){
        $task = Task::findorfail($id);
        return $task->delete();
    }

    public function search($filters = []){
        $query = Task::with('department');

        if (!empty($filters['department_id'])) {
            $query->where('department_id', $filters['department_id']);
        }

        if (!empty($filters['employee_name'])) {
            $query->where('employee_name', 'like', '%' . $filters['employee_name'] . '%');
        }

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('date', [$filters['start_date'], $filters['end_date']]);
        }

        return $query->orderBy('id', 'desc')->get();
    }

    public function findOne(int $id)
    {
        return Task::findOrFail($id);
    }

    public function approve(int $id){
        $task = Task::findorfail($id);

        return $task->update(['is_approved' => true]);
    }

    public function taskCount(){
        return Task::count();
    }

    public function taskApprovedCount(){
        return Task::where('is_approved', 1)->count();
    }
    public function taskUnapprovedCount(){
        return Task::where('is_approved', 0)->count();
    }
}
