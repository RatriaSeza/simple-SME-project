<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendanceExport implements WithHeadings, FromQuery, WithMapping, WithStyles, ShouldAutoSize
{
    use Exportable;

    public function query()
    {
        $employees = Employee::query()->with('attendances');
        $employees->withCount('attendances as total_working_days');

        return $employees;
    }

    public function map($employee): array
    {
        return [
            $employee->employee_id,
            $employee->first_name . ' ' .$employee->last_name,
            $employee->total_working_days,
            $employee->total_working_hours(),
        ];
    }

    public function headings(): array
    {
        return [
            'Employee ID',
            'Employee Name',
            'Total Working Days',
            'Total Working Hours',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

}
