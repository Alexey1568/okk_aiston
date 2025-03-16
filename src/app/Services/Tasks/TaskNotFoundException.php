<?php

namespace App\Services\Tasks;

class TaskNotFoundException extends \Exception
{

    /**
     * @param string $string
     */
    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}
