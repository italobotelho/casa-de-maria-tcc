<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
     *  @return array
     */

     public function rules(): array
     {
         return [
            'title' => 'required',
            'start' => 'required|date_format:Y-m-d H:i:s|before:end',
            'end' => 'required|date_format:Y-m-d H:i:s|after:start',
            'color' => 'required',
            'procedimento_id' => 'required',
            'medico' => 'required',
            'convenio' => 'required',
         ];
     }
     
     public function messages(): array    
     {
         return [
            'procedimento_id.required' => 'Selecione um procedimento',
            'medico.required' => 'O campo médico é obrigatório.',
            'convenio.required' => 'O campo convenio é obrigatório.',
            'start.date_format' => 'Preencha uma data inicial com valor válido!',
            'start.before' => 'A data/hora inicial deve ser menor que a data final',
            'end.date_format' => 'Preencha uma data final com valor válido!',
            'end.after' => 'A data/hora final deve ser maior que a data inicial',
         ];
     }
}
