<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    public $fillable = ['date', 'employee_name', 'employee_id', 'department_id', 'task_details', 'hours_worked','is_approved'];

    // task belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    // task belongs to a department
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
