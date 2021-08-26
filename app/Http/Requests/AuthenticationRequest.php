<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationRequest extends FormRequest
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
    public function rules() : array
    {
        return [
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages() : array
    {
        return [
            'email.required'    => 'A email is required',
            'email.string'      => 'A email must be string',
            'email.email'       => 'A email must be valid email',
            'email.max:255'     => 'A email must be of maximum 255 characters',
            'password.string'   => 'A password must be string',
            'password.required' => 'A password is required',
            'password.min:8'    => 'A password must be 8 characters',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json(
                ['code' => 'VALIDATION_ERROR', 'errors' => $errors],
                Response::HTTP_UNPROCESSABLE_ENTITY
            )
        );
    }
}
