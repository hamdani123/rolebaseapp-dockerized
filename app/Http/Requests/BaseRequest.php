<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use App\Utils\ApiStatusCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    use ApiResponse;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        foreach ($errors as $key => $error){
            $errors[$key] = current($error);
        }
        throw new HttpResponseException(
            $this->sendApiResponse(
                ApiStatusCode::VALIDATION_FAILED,
                $errors,
                "Validation failed"
            )
        );

    }
}
