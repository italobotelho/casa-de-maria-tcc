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
            'title'=> 'required|min:3'
            
        ];
    }

    public function message(){
        return[
            'title.required' => 'Prencha o campo Titulo',
            'title.min' => 'Titulo necessita de pelo menos 03 caracteres',
            


        ];
    }
}
