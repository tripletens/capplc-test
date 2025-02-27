<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService {
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function create(array $data){
        return $this->taskRepository->create($data);
    }

    public function getAll() {
        return $this->taskRepository->getAll();
    }

    public function search(array $filter = []){
        return $this->taskRepository->search($filter);
    }

    public function findOne(int $id){
        return $this->taskRepository->findOne($id);
    }

    public function approve(int $id){
        return $this->taskRepository->approve($id);
    }

    public function numberOfTasks(){
        return $this->taskRepository->taskCount();
    }

    public function numberOfApprovedTasks(){
        return $this->taskRepository->taskApprovedCount();
    }
    public function numberOfUnapprovedTasks(){
        return  $this->taskRepository->taskUnapprovedCount();
    }
}
