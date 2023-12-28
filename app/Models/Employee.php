<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;

    public const MARITAL_STATUS = ['Single', 'Married', 'Divorced'];

    public const GENDER = ['Male', 'Female'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['employee_id', 'first_name', 'last_name', 'nick_name', 'birth_date', 'position', 'gender', 'education', 'id_number', 'marital_status', 'join_date'];


    public function generate_id($join_date)
    {
        return 'EMP' .  str_replace('-', '', $join_date) . rand(1000, 9999);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'employee_id', 'employee_id');
    }

    public function total_working_hours()
    {
        return $this->attendances()->get()->sum('working_hours');
    }
}
