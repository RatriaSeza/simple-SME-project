<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeControllerRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();

        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeControllerRequest $request)
    {
        $validated = $request->validated();
        $validated['employee_id'] = $this->generate_id($validated['join_date']);

        $employee = Employee::create($validated);

        return redirect(route('employees.index'))->with('status', 'Data employee ' . $employee->employee_id .' added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $employee_id)
    {
        $employee = Employee::where('employee_id', $employee_id)->first();

        dd($employee);
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

    public function generate_id($join_date)
    {
        return 'EMP' .  str_replace('-', '', $join_date) . rand(1000, 9999);
    }
}
