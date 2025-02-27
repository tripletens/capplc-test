<?php

namespace App\Interfaces;

interface DepartmentRepositoryInterface {
    public function create(array $data);
    public function getAll();
    public function update(array $data, int $id);
    public function delete(int $id);
}
