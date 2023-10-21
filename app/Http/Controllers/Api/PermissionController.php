<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermissionRequest;
use App\Http\Requests\UserRoleRequest;
use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function setUserRole(UserRoleRequest $request): JsonResponse
    {
        $inputData = $request->all();
        $user_id = $inputData['user_id'];
        $role_ids = $inputData['role_ids'];

        $permissionService = new PermissionService();
        $permissionService->setUserRole($user_id, $role_ids);

        return $this->sendApiResponse(
            $permissionService->code,
            $permissionService->result,
            $permissionService->message
        );
    }

    public function setRolePermission(RolePermissionRequest $request): JsonResponse
    {
        $inputData = $request->all();

        $role_id = $inputData['role_id'];
        $permission_ids = $inputData['permission_ids'];

        $permissionService = new PermissionService();
        $permissionService->setRolePermission($role_id, $permission_ids);

        return $this->sendApiResponse(
            $permissionService->code,
            $permissionService->result,
            $permissionService->message
        );
    }
}
