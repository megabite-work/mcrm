<?php

declare(strict_types=1);

namespace App\Component;

class EntityNotFoundException extends \RuntimeException
{
    public function __construct($message = '')
    {
        parent::__construct($message);
    }
}
