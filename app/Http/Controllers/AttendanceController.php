<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Http\Requests\AttendanceControllerRequest;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->format('m');
        $currentYear = $currentDate->format('Y');

        $filter = $request->query();

        $employees = DB::table('employees')
            ->leftJoin('attendances', 'employees.employee_id', '=', 'attendances.employee_id')
            ->select(
                'employees.employee_id',
                'employees.nick_name',
                'employees.position',
                'employees.gender',
                DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) as full_name"),
                DB::raw('COUNT(attendances.attendance_date) as total_working_days'),
                DB::raw('SUM(attendances.working_hours) as total_working_hours')
            )
            ->whereRaw("EXTRACT(MONTH FROM attendances.attendance_date) = ? AND EXTRACT(YEAR FROM attendances.attendance_date) = ?", [$filter['month'] ?? $currentMonth, $filter['year'] ?? $currentYear])
            ->groupBy('employees.employee_id', 'full_name', 'employees.position', 'employees.nick_name', 'employees.gender')
            ->orderBy('full_name')
            ->get();

        $attendancesExport = $employees;

        return view('attendance.index', compact('employees', 'attendancesExport', 'currentMonth', 'currentYear'));
    }

    /**
     * Display a list of attendances by specific user.
     */
    public function detail(string $employee_id, Request $request)
    {
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->format('m');
        $currentYear = $currentDate->format('Y');

        $queryAttendances = Attendance::query()->where('employee_id', $employee_id)->orderBy('attendance_date', 'desc');

        if ($request->filled('month')) {
            $queryAttendances->whereMonth('attendance_date', $request->query('month'));
        } else {
            $queryAttendances->whereMonth('attendance_date', $currentMonth);
        }

        if ($request->filled('year')) {
            $queryAttendances->whereYear('attendance_date', $request->query('year'));
        } else {
            $queryAttendances->whereYear('attendance_date', $currentYear);
        }

        $attendances = $queryAttendances->get();
        $employee = Employee::where('employee_id', $employee_id)->first();


        return view('attendance.detail', compact('attendances', 'employee', 'currentYear', 'currentMonth'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $employee_id, Request $request)
    {
        $employee = Employee::where('employee_id', $employee_id)->first();

        return view('attendance.create', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $employee_id, AttendanceControllerRequest $request)
    {
        $validated = $request->validated();

        $validated['employee_id'] = $employee_id;
        $validated['day'] = Carbon::parse($validated['attendance_date'])->dayName;
        $validated['working_hours'] = $this->getTotalWorkingHours($validated['time_in'], $validated['time_out'], $validated['break_time_start'], $validated['break_time_end']);

        $attendance = Attendance::create($validated);

        return redirect(route('attendances.detail', $employee_id))->with('status', 'Data attendance ' . $attendance->attendance_date . ' added!');
    }

    // TODO:UPDATE DATA

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->back()->with('status', 'Data ' . $attendance->attendance_date . ' deleted!');
    }

    /**
     * Export data to excel file.
     */
    public function export(Request $request)
    {
        $data = json_decode($request->input('employees'), true);
        $month = Carbon::createFromFormat('m', $request->input('export_month'))->format('F');;
        $year = $request->input('export_year');

        $attendancesData = Arr::map($data, function ($item) {
            return Arr::only($item,  ['employee_id', 'full_name', 'total_working_days', 'total_working_hours']);
        });

        return Excel::download(new AttendanceExport($attendancesData), 'Attendances of ' . $month . ' ' . $year . '.xlsx');
    }

    /**
     * Get total working hours of attendance data.
     */
    // TODO: if one of parameter empty
    public function getTotalWorkingHours(string $time_in, string $time_out, string $break_time_start, string $break_time_end): string
    {
        $time_in = Carbon::parse($time_in);
        $time_out = Carbon::parse($time_out);

        $totalWorkingHours = $time_out->diffInMinutes($time_in);

        if ($break_time_start && $break_time_end) {
            $break_time_start = Carbon::parse($break_time_start);
            $break_time_end = Carbon::parse($break_time_end);

            $totalWorkingHours = $totalWorkingHours - $break_time_end->diffInMinutes($break_time_start);
        }

        $totalWorkingMinutes = (string) $totalWorkingHours % 60;
        $totalWorkingHours = (string) floor($totalWorkingHours / 60);

        return $totalWorkingHours . ':'. $totalWorkingMinutes;
    }
}
