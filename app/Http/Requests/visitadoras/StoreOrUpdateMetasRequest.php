<?php

namespace App\Http\Requests\visitadoras;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateMetasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'month' => 'required|date_format:Y-m', // Year & Month
            'tipo_medico' => 'required|string|max:255',
            'is_general_goal' => 'required|boolean', // If is a single Goal for Every1 or Specific Goals
            // Required if is_general_goal === FALSE
            'visitor_goals' => 'required_if:is_general_goal,false|array',
            'visitor_goals.*.user_id' => 'required_if:is_general_goal,false|exists:users,id',
            'visitor_goals.*.goal_amount' => 'required_if:is_general_goal,false|numeric|min:0',
            'visitor_goals.*.commission_percentage' => 'required_if:is_general_goal,false|numeric|min:0|max:99.99',
            // Required if is_general_goal === TRUE
            'goal_amount' => 'required_if:is_general_goal,true|numeric|min:0',
            'commission_percentage' => 'required_if:is_general_goal,true|numeric|min:0|max:99.99',
        ];
    }
    public function messages(): array
    {
        return [
            'month.required' => 'El campo mes es obligatorio.',
            'tipo_medico.required' => 'Debes seleccionar un tipo de médico.',
            'is_general_goal.required' => 'Debe indicar si la meta será para todas las visitadoras o definirá para cada una.',
            'visitor_goals.required_if' => 'Debe especificar metas para cada visitadora.',
            'visitor_goals.array' => 'El campo visitor_goals debe ser un array.',
            'visitor_goals.*.user_id.required_if' => 'Debe indicar el ID de las visitadoras',
            'visitor_goals.*.user_id.exists' => 'Algunos de los User ID no existen.',
            'visitor_goals.*.goal_amount.required_if' => 'Debe especificar una meta por cada visitadora.',
            'visitor_goals.*.goal_amount.numeric' => 'El monto de la meta debe ser numérico.',
            'visitor_goals.*.goal_amount.min' => 'El monto de la meta no puede ser negativo.',
            'visitor_goals.*.commission_percentage.required_if' => 'Cada visitadora debe tener un porcentaje de comisión.',
            'visitor_goals.*.commission_percentage.numeric' => 'El porcentaje de comisión debe ser numérico.',
            'visitor_goals.*.commission_percentage.min' => 'El porcentaje de comisión no puede ser menor que 0%.',
            'visitor_goals.*.commission_percentage.max' => 'El porcentaje de comisión no puede ser mayor que 99.99%.',
            'goal_amount.required_if' => 'Se debe definir la meta general que se aplicará a todas las visitadoras.',
            'goal_amount.numeric' => 'El monto de la meta debe ser numérico.',
            'goal_amount.min' => 'El monto de la meta no puede ser negativo.',
            'commission_percentage.required_if' => 'Se debe definir el porcentaje de comisión que se aplicará a todas las visitadoras.',
            'commission_percentage.numeric' => 'El porcentaje de comisión debe ser numérico.',
            'commission_percentage.min' => 'El porcentaje de comisión no puede ser menor que 0%.',
            'commission_percentage.max' => 'El porcentaje de comisión no puede ser mayor que 99.99%.',
        ];
    }
}
