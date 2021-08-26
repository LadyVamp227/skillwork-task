<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ArticlesRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title'   => 'required|string|max:255',
            'content' => 'required|string|max:255',
        ];
    }

    public function messages() : array
    {
        return [
            'title.required'     => 'A title is required',
            'title.string'       => 'A title must be string',
            'title.max:255'      => 'A title must be of maximum 255 characters',
            'content.max:255'       => 'A conent must be of maximum 255 characters',
            'content.string'    => 'A conent must be string',
            'content.required'  => 'A conent is required',
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
