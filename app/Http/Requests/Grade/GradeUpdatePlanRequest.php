<?php

namespace App\Http\Requests\Grade;

use Illuminate\Foundation\Http\FormRequest;

class GradeUpdatePlanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'lectures'=>'required|array',
            'lectures.*'=>'exists:lectures,id'
        ];
    }
    public function messages()
    {
        return [
            'lectures.required'=>'Выбор урока обязательно',
            'lectures.array'=>'Уроки должны быть массивом',
            'lectures.*.exists'=>'Урока с указанным ID не существует'
        ];
    }
}
