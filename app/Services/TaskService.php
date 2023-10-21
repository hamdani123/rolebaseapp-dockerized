<?php

namespace App\Services;

use App\Models\Task;
use App\Utils\ApiStatusCode;

class TaskService extends Service
{

    public function __construct()
    {
        $this->model = $this->makeModel();
    }

    protected function makeModel(): Task
    {
        return new Task();
    }

    public function add($inputData)
    {
        $this->code = ApiStatusCode::FAILED;

        try {

            $this->result = $this->model->add($inputData);

            if(empty($this->result)){
                throw new \Exception(__('Task has failed to add. Please try again'));
            }

            $this->message = __('Task has been added successfully.');
            $this->code = ApiStatusCode::SUCCESS;

        } catch (\Exception $ex) {
            $this->message = $ex->getMessage();
        }
    }

    public function update($id,$inputData)
    {
        $this->code = ApiStatusCode::FAILED;

        try {

            $this->result = $this->model->updateById($id,$inputData);

            if(empty($this->result)){
                throw new \Exception(__('Task has failed to update. Please try again'));
            }

            $this->message = __('Task has been updated successfully.');
            $this->code = ApiStatusCode::SUCCESS;

        } catch (\Exception $ex) {
            $this->message = $ex->getMessage();
        }
    }

    public function delete($clause)
    {
        $this->code = ApiStatusCode::FAILED;

        try {

            $this->result = $this->model->deleteById($clause);

            if(empty($this->result)){
                throw new \Exception(__('Task has failed to delete. Please try again'));
            }

            $this->message = __('Task has been deleted successfully.');
            $this->code = ApiStatusCode::SUCCESS;
            $this->result = [];

        } catch (\Exception $ex) {
            $this->message = $ex->getMessage();
        }
    }

    public function getById($clause)
    {
        $this->code = ApiStatusCode::SUCCESS;
        $this->message = "No data found";
        $this->result = $this->model->getById($clause);

        if(!empty($this->result)){
            $this->message = __('Fetched successfully.');
        }

    }

    public function getItems($search = [])
    {
        $this->code = ApiStatusCode::SUCCESS;
        $this->message = "No data found";
        $this->result = $this->model->getAll($search)->toArray();

        if(!empty($this->result)){
            $this->message = __('Fetched successfully.');
        }

    }
}
