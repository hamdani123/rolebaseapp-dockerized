<?php

namespace App\Services;

abstract class Service
{
    public $code = "";
    public $result = [];
    public $message = "";
    protected $model = null;

    abstract protected function makeModel();
}
