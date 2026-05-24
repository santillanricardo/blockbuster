<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRentaRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cliente_id'       => 'required|exists:clientes,id',
            'pelicula_id'      => 'required|exists:peliculas,id',
            'fecha_renta'      => 'required|date',
            'fecha_devolucion' => 'required|date|after:fecha_renta',
            'estatus'          => 'required|in:activa,devuelta,vencida',
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_devolucion.after' => 'La fecha de devolución debe ser posterior a la fecha de renta.',
            'cliente_id.exists'      => 'El cliente seleccionado no existe.',
            'pelicula_id.exists'     => 'La película seleccionada no existe.',
        ];
    }
}
