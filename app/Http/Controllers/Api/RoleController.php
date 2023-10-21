<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;


class RoleController extends Controller
{
    private $roleservice = null;

    public function __construct(RoleService $roleservice)
    {
        $this->roleservice = $roleservice;
    }

    public function getRoleList() : JsonResponse
    {
        //$clause['user_id'] = auth()->id();

        $this->roleservice->getItems();

        return $this->sendApiResponse(
            $this->roleservice->code,
            $this->roleservice->result,
            $this->roleservice->message
        );
    }

    public function add(RoleRequest $request) : JsonResponse
    {

        $inputData = $request->all();
        //$inputData['user_id'] = auth()->id();

        $this->roleservice->add($inputData);

        return $this->sendApiResponse(
            $this->roleservice->code,
            $this->roleservice->result,
            $this->roleservice->message
        );
    }

    public function update($id, RoleRequest $request) : JsonResponse
    {
        $inputData = $request->all();
        $clause['id'] = $id;

        $this->roleservice->update($clause, $inputData);

        return $this->sendApiResponse(
            $this->roleservice->code,
            $this->roleservice->result,
            $this->roleservice->message
        );
    }

    public function delete($id) : JsonResponse
    {
        $clause['id'] = $id;

        $this->roleservice->delete($clause);

        return $this->sendApiResponse(
            $this->roleservice->code,
            $this->roleservice->result,
            $this->roleservice->message
        );
    }

    public function getRole($id) : JsonResponse
    {
        $clause['id'] = $id;

        $this->roleservice->getById($clause);

        return $this->sendApiResponse(
            $this->roleservice->code,
            $this->roleservice->result,
            $this->roleservice->message
        );
    }
}
