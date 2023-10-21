<?php

namespace App\Http\Requests;


class RolePermissionRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'role_id'=>'required|integer',
            'permission_ids'=>'required|array'
        ];
    }
}
