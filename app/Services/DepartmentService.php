<?php 

namespace App\Services;

use App\Repositories\DepartmentRepository;

class DepartmentService {
    protected $departmentRepository;

    // dependency injection here i.e passing the department repository to the service construct 
    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function getAll(){
        return $this->departmentRepository->getAll();
    }

    // create the department 
    public function create(array $data){
        return $this->departmentRepository->create($data);
    }

    // update the department 
    public function update(array $data, int $id){
        return $this->departmentRepository->update($data, $id);
    }

    // delete the department 
    public function delete(int $id){
        return $this->departmentRepository->delete($id);
    }
}