<?php

namespace App\Http\Requests\Lecture;

use Illuminate\Foundation\Http\FormRequest;

class LectureStoreRequest extends FormRequest
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
            'name'=>'required|unique:lectures,name',
            'description'=>'required',
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Имя обязательно',
            'name.unique'=>'Имя должно быть уникально',
            'description'=>'Описание обязательно',
        ];
    }
}
