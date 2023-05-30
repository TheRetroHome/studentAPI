<?php

namespace App\Http\Requests\Grade;

use Illuminate\Foundation\Http\FormRequest;

class GradeUpdateRequest extends FormRequest
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
            'name'=>'sometimes|required|unique:grades,name'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Имя обязательно',
            'name.unique'=>'Имя должно быть уникально',
        ];
    }
}
