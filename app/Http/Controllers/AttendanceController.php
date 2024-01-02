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

        $queryMonth = $filter['month'] ?? $currentMonth;
        $queryYear = $filter['year'] ?? $currentYear;

        $employees = Employee::withCount(['attendances as total_working_days' => function ($query) use ($queryMonth, $queryYear) {
            $query->where('working_hours', '<>', '00:00:00')
                ->whereMonth('attendance_date', $queryMonth)
                ->whereYear('attendance_date', $queryYear);
            }])
            ->withSum(['attendances' => function ($query) use ($queryMonth, $queryYear) {
                $query->where('working_hours', '<>', '00:00:00')
                    ->whereMonth('attendance_date', $queryMonth)
                    ->whereYear('attendance_date', $queryYear);
            }] , 'working_hours')
            ->orderBy('first_name')
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

        if ($request->leave) {
            $validated['working_hours'] = '00:00:00';
        } else {
            $validated['working_hours'] = $this->getTotalWorkingHours($validated['time_in'], $validated['time_out'], $validated['break_time_start'], $validated['break_time_end']);
        }

        $attendance = Attendance::create($validated);

        list($year, $month, $day) = explode('-', $attendance->attendance_date); // get year, month, day of attendance date

        return redirect(route('attendances.detail', [$employee_id, 'year' => $year, 'month' => $month]))->with('status', "Data attendance $attendance->attendance_date added!");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $employee_id, string $attendance_date)
    {
        $attendance = Attendance::where('employee_id', $employee_id)
            ->where('attendance_date', $attendance_date)
            ->first();

        return view('attendance.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendanceControllerRequest $request, string $employee_id, Attendance $attendance)
    {
        $validated = $request->validated();
        $validated['day'] = Carbon::parse($validated['attendance_date'])->dayName;

        if ($request->leave) {
            $validated['working_hours'] = '00:00:00';
            $validated['time_in'] = null;
            $validated['time_out'] = null;
            $validated['break_time_start'] = null;
            $validated['break_time_end'] = null;
        } else {
            $validated['working_hours'] = $this->getTotalWorkingHours($validated['time_in'], $validated['time_out'], $validated['break_time_start'], $validated['break_time_end']);
        }

        list($year, $month, $day) = explode('-', $attendance->attendance_date); // get year, month, day of attendance date

        $attendance->update($validated);

        return redirect(route('attendances.detail', [$employee_id, 'year' => $year, 'month' => $month]))->with('status', "Data employee $attendance->attendance_date updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->back()->with('status', "Data $attendance->attendance_date deleted!");
    }

    /**
     * Export data to excel file.
     */
    public function export(Request $request)
    {
        $data = json_decode($request->input('employees'), true);
        $month = Carbon::createFromFormat('m', $request->input('export_month'))->format('F');;
        $year = $request->input('export_year');

        // concat first_name and last_name into full_name
        $getFullName = Arr::map($data, function ($item) {
            $item['full_name'] = $item['first_name'] . ' ' . $item['last_name'];
            unset($item['first_name']);
            unset($item['last_name']);
            return $item;
        });

        // reorder key
        $result = Arr::map($getFullName, function ($item) {
            return [
                'employee_id' => $item['employee_id'],
                'full_name' => $item['full_name'],
                'total_working_days' => $item['total_working_days'],
                'attendances_sum_working_hours' => $item['attendances_sum_working_hours'],
            ];
        });

        return Excel::download(new AttendanceExport($result), "Attendances of $month $year.xlsx");
    }

    /**
     * Get total working hours of attendance data.
     */
    public function getTotalWorkingHours(string $time_in, string $time_out, string $break_time_start, string $break_time_end): string
    {
        $time_in = Carbon::parse($time_in);
        $time_out = Carbon::parse($time_out);
        $break_time_start = Carbon::parse($break_time_start);
        $break_time_end = Carbon::parse($break_time_end);

        $totalWorkingHours = $time_out->diffInMinutes($time_in);
        $totalWorkingHours = $totalWorkingHours - $break_time_end->diffInMinutes($break_time_start);

        $totalWorkingMinutes = (string) $totalWorkingHours % 60;
        $totalWorkingHours = (string) floor($totalWorkingHours / 60);

        return $totalWorkingHours . ':'. $totalWorkingMinutes;
    }
}
