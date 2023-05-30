<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|email|unique:students,email',
            'grade_id'=>'required|exists:grades,id'
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Поле "Имя" обязательно к заполнению',
            'email.required'=>'Поле "email" обязательно к заполнению',
            'email.email'=>'Формат email должен соответствовать',
            'email.unique'=>'Email должен быть уникальным',
            'grade_id.required'=>'Класс обязателен к указанию',
            'grade_id.exists'=>'Класса не существует',
        ];
    }
}
