<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class TaskController extends Controller
{
    private $taskservice = null;

    public function __construct(TaskService $taskService)
    {
        $this->taskservice = $taskService;
    }

    public function getTaskList() : JsonResponse
    {
        $clause['user_id'] = auth()->id();

        $this->taskservice->getItems($clause);

        return $this->sendApiResponse(
            $this->taskservice->code,
            $this->taskservice->result,
            $this->taskservice->message
        );
    }

    public function add(TaskRequest $request) : JsonResponse
    {

        $inputData = $request->all();
        $inputData['user_id'] = auth()->id();

        $this->taskservice->add($inputData);

        return $this->sendApiResponse(
            $this->taskservice->code,
            $this->taskservice->result,
            $this->taskservice->message
        );
    }

    public function update($id, TaskRequest $request) : JsonResponse
    {
        $inputData = $request->all();
        $clause['user_id'] = auth()->id();
        $clause['id'] = $id;
        $inputData['user_id'] = $clause['user_id'];

        $this->taskservice->update($clause, $inputData);

        return $this->sendApiResponse(
            $this->taskservice->code,
            $this->taskservice->result,
            $this->taskservice->message
        );
    }

    public function delete($id) : JsonResponse
    {
        $clause['user_id'] = auth()->id();
        $clause['id'] = $id;

        $this->taskservice->delete($clause);

        return $this->sendApiResponse(
            $this->taskservice->code,
            $this->taskservice->result,
            $this->taskservice->message
        );
    }

    public function getTask($id) : JsonResponse
    {
        $clause['user_id'] = auth()->id();
        $clause['id'] = $id;

        $this->taskservice->getById($clause);

        return $this->sendApiResponse(
            $this->taskservice->code,
            $this->taskservice->result,
            $this->taskservice->message
        );
    }


}
