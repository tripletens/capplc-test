<?php

namespace App\Interfaces;

interface TaskRepositoryInterface {

    // fetch all the tasks
    public function getAll();

    // here we create task
    public function create(array $data);

    // update the task
    public function update(array $data, int $id);

    // delete the task
    public function delete(int $id);

    // search the task
    public function search(array $filter = []);

    // find one task 
    public function findOne(int $id);

    // approve task
    public function approve(int $id);

    // no of tasks 
    public function taskCount();

    // no of approved tasks 
    public function taskApprovedCount();

    // no of unapproved tasks
    public function taskUnapprovedCount();
    
}
