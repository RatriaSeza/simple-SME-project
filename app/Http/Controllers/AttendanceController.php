<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Models\Attendance;
use App\Models\Employee;
use Attribute;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    public function index(): View
    {
        $data = DB::table('employees')
            ->leftJoin('attendances', 'employees.employee_id', '=', 'attendances.employee_id')
            ->select('employees.employee_id',
                'employees.nick_name',
                'employees.position',
                'employees.gender',
                DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) as full_name"),
                DB::raw('COUNT(attendances.attendance_date) as total_working_days'),
                DB::raw('SUM(attendances.working_hours) as total_working_hours'))
            ->groupBy('employees.employee_id', 'full_name', 'employees.position', 'employees.nick_name', 'employees.gender')
            ->orderBy('full_name')
            ->get();

        return view('attendances', [
            'employees' => $data
        ]);
    }

    public function generate_excel()
    {

        return (new AttendanceExport)->download('Attendances.xlsx');
    }
}
