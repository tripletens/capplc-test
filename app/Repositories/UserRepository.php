<?php 
namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Task;
use App\Models\User;

class UserRepository implements UserRepositoryInterface {
    
    public function fetchEmployees(){
        return User::where('role','employee')->get();
    }

    public function employeeCount(){
        return User::where('role','employee')->get()->count();
    }
}
