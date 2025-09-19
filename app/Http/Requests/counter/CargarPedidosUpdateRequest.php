<?php

namespace App\Http\Requests\counter;

use Illuminate\Foundation\Http\FormRequest;

class CargarPedidosUpdateRequest extends FormRequest
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
            'deliveryDate' => 'required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d'),
            'customerNumber' => 'nullable|string|max:20',
            'doctorName' => 'required|string|max:255',
            'id_doctor' => 'nullable|exists:doctor,id',
            'address' => 'required|string|max:500',
            'district' => 'required|string|max:100',
            'zone_id' => 'required|exists:zones,id',
        ];
    }
}
