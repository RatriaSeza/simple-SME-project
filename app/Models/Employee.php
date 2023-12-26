<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public const MARITAL_STATUS = ['Single', 'Married', 'Divorced'];

    public const GENDER = ['Male', 'Female'];

    public function generate_id($join_date) {
        return 'EMP' .  str_replace('-', '', $join_date) . rand(1000, 9999);
    }
}
