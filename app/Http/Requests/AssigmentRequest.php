<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssigmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supervisor' => 'required|string',
            'assignments' => 'array|max:5',
            'assignments.*.date' => 'required|max:500',
            'assignments.*.note' => 'required|max:500',
            // 'manager' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'assignments.array' => 'A title is required',
            'assignments.*.date.required' => 'Tarikh tugasan wajib diisi',
            'assignments.*.note.required' => 'Catatan tugasan wajib diisi',
        ];
    }
}
