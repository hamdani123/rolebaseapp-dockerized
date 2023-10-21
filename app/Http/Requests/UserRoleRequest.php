<?php

namespace App\Http\Requests;


class UserRoleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=>'required|integer',
            'role_ids'=>'required|array'
        ];
    }
}
