<?php
namespace App\Interfaces;

interface UserRepositoryInterface {
    public function fetchEmployees();
    public function employeeCount();
}
