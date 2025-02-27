<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DepartmentController extends Controller
{

    use AuthorizesRequests;

    protected $departmentService;
    
    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Department::class);

        $departments = $this->departmentService->getAll();
        // view the department page 
        return view('pages.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // view create department page
        return view('pages.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $this->authorize('create', Department::class);

        try {
            $department = $this->departmentService->create($request->validated());
    
            flash()->success('Department created successfully.');

            return redirect()->route('department.index')->with('success', 'Department created successfully.');
            
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            Log::error('Error creating department: ' . $e->getMessage());
    
            return redirect()->back()->with('error', 'Failed to create department. Please try again.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
