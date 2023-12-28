<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Models\Attendance;
use App\Models\Employee;
use Attribute;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    public function index(): View
    {
        $employees = Employee::query()->with('attendances');

        $employees->withCount('attendances as total_working_days');

        $data = $employees->get();

        return view('attendances', [
            'employees' => $data
        ]);
    }

    public function generate_excel()
    {
        $employees = Employee::query()->with('attendances');

        $employees->withCount('attendances as total_working_days');

        $data = $employees
        // ->select(['employee_id', 'first_name', 'last_name'])
        ->get();

        return (new AttendanceExport)->download('Attendances.xlsx');
    }
}
