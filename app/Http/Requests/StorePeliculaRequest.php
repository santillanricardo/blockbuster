<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeliculaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'titulo'             => 'required|string|max:255',
            'genero'             => 'required|string|max:100',
            'anio'               => 'required|integer|min:1888|max:' . date('Y'),
            'sinopsis'           => 'nullable|string',
            'copias_disponibles' => 'required|integer|min:0',
            'imagen'             => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required'             => 'El título es obligatorio.',
            'genero.required'             => 'El género es obligatorio.',
            'anio.required'               => 'El año es obligatorio.',
            'anio.min'                    => 'El año no puede ser menor a 1888.',
            'copias_disponibles.required' => 'Las copias disponibles son obligatorias.',
            'copias_disponibles.min'      => 'Las copias no pueden ser negativas.',
        ];
    }
}