<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\DepartmentService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use AuthorizesRequests;

    protected $taskService, $departmentService;

    public function __construct(TaskService $taskService, DepartmentService $departmentService)
    {
        $this->taskService = $taskService;
        $this->departmentService = $departmentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Task::class);

        $tasks = $this->taskService->getAll();

        $departments = $this->departmentService->getAll();

        $options = $departments->pluck('name', 'id')->toArray();

        return view('pages.tasks.index', compact('tasks', 'options'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = $this->departmentService->getAll();

        $options = $departments->pluck('name', 'id')->toArray();

        // lets see the page the create the task
        return view('pages.tasks.create', compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $this->authorize('create', Task::class);

        // lets finally validate and save the task to the db
        try {
            $user = Auth::user();

            if (!$user) {
                return redirect()->back()->with('error', 'User is not authenticated.');
            }

            $taskData = array_merge($request->validated(), [
                'employee_id' => $user->id,
                'employee_name' => $user->name,
            ]);

            // dd($taskData);

            $task = $this->taskService->create($taskData);

            return redirect()->route('task.index')->with('success', 'Task created successfully.');
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            Log::error('Error creating task: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to create task. Please try again.');
        }
    }

    public function search(SearchRequest $request)
    {
        $this->authorize('search', Task::class);

        // dd($request);
        try {
            // Get filters from the request
            $filters = [
                'department_id' => $request->input('department_id'),
                'employee_name' => $request->input('employee_name'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
            ];

            $tasks = $this->taskService->search($filters);

            // dd($tasks);

            $departments = $this->departmentService->getAll();

            $options = $departments->pluck('name', 'id')->toArray();

            return view('pages.tasks.index', compact('tasks', 'options'));
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            Log::error('Error searching task: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to search task. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        // dd($task);

        $departments = $this->departmentService->getAll();

        $options = $departments->pluck('name', 'id')->toArray();

        return view('pages.tasks.edit', compact('task', 'options'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(TaskRequest $request, Task $task)
    {
        try {
            // Authorize the update action
            $this->authorize('update', $task);

            // Validate request data
            $validatedData = $request->validated();

            // Update task
            $task->update($validatedData);

            return redirect()->route('task.index')->with('success', 'Task updated successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating task: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to update task. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Task $task)
    {
        try {
            // dd($task);

            // Authorize the delete action
            $this->authorize('delete', $task);

            // Delete the task
            $task->delete();

            return redirect()->route('task.index')->with('success', 'Task deleted successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error deleting task: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Failed to delete task. Please try again.');
        }
    }

    public function approve(Task $task)
    {
        // Check if the authenticated user can approve the task
        $this->authorize('approveTask', $task);

        // Update task status to approved
        $task->is_approved = true;
        $task->save();

        return redirect()->back()->with('success', 'Task approved successfully.');
    }
}
