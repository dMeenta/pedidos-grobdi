<?php

namespace App\Http\Requests\rutas;

use Illuminate\Foundation\Http\FormRequest;

class DoctorStoreRequest extends FormRequest
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
            'name' => 'required',
            'cmp' => 'required',
            'phone' => 'required',
            'distrito_id' => 'required',
            'centrosalud_id' => 'required',
            'especialidad_id' => 'required',
        ];
    }
}
