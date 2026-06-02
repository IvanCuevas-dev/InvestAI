<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()->symbols()->uncompromised()],
        ];
    }


    public function messages(): array
    {
        return [
            'name.required'  => 'El nombre es obligatorio.',
            'name.max'       => 'El nombre supera la longitud máxima.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email'    => 'El formato del correo electrónico no es válido.',
            'email.max'      => 'El correo electrónico supera la longitud máxima.',
            'email.unique'   => 'El correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.letters' => 'La contraseña debe incluir al menos una letra.',
            'password.mixed' => 'La contraseña debe incluir al menos una mayúscula y una minúscula.',
            'password.numbers' => 'La contraseña debe incluir al menos un número.',
            'password.symbols' => 'La contraseña debe incluir al menos un símbolo.',
            'password.uncompromised' => 'La contraseña aparece en filtraciones de datos. Elige una más segura.',
        ];
    }


    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => strtolower(trim($this->input('email'))),
            'name'  => trim($this->input('name'))
        ]);
    }
}
