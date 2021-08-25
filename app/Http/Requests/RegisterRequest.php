<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class RegisterRequest extends FormRequest
{

//    protected $redirectRoute = 'register';
//    /**
//     * Determine if the user is authorized to make this request.
//     *
//     * @return bool
//     */
    public function authorize() : bool
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
            'email'    => 'required|string|email|max:255|unique:users',
            'name'     => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages() : array
    {
        return [
            'email.required'     => 'A email is required',
            'email.string'       => 'A email must be string',
            'email.email'        => 'A email must be valid email',
            'email.max:255'      => 'A email must be of maximum 255 characters',
            'email.unique:users' => 'A email must be unique',
            'name.required'      => 'A name is required',
            'name.max:255'       => 'A name must be of maximum 255 characters',
            'name.string'        => 'A name must be string',
            'password.string'    => 'A password must be string',
            'password.required'  => 'A password is required',
            'password.min:8'     => 'A password must be 8 characters',
            'password.confirm'   => 'A password must be confirmed',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(   ['code'=> 'VALIDATION_ERROR','errors' => $errors
                                                         ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
