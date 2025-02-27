<?php

namespace App\Repositories;

use App\Interfaces\DepartmentRepositoryInterface;
use App\Models\Department;

class DepartmentRepository implements DepartmentRepositoryInterface {

    public function getAll()
    {
        return Department::all();
    }

    public function create(array $data){
        Department::create($data);
    }

    public function update(array $data, int $id){
        $department = Department::findorfail($id);

        $department->update($data);

        return $department;
    }

    public function delete(int $id){
        $department = Department::findorfail($id);

        return $department->delete();
    }

}
