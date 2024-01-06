<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeControllerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:255|string',
            'last_name' => 'required|max:255|string',
            'nick_name' => 'nullable|max:255|string',
            'birth_date' => 'required|date',
            'position' => 'required|max:255|string',
            'gender' => 'required|max:255|string',
            'education' => 'required|max:100|string',
            'id_number' => 'required|max:255|string',
            'marital_status' => 'required|max:255|string',
            'join_date' => 'required|date',
        ];
    }
}
