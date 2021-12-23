<?php

namespace App\Http\Requests;

use App\Rules\UnitRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
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
            'length'        => 'required|integer|min:1|max:100000',
            'width'         => 'required|integer|min:1|max:100000',
            'depth'         => 'required|integer|min:1|max:100000',
            'unit'          => ['required','string','min:1','max:200',new UnitRule()],
            'depth_unit'    => ['required','string','min:1','max:200',new UnitRule()],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
