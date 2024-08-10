<?php

declare(strict_types=1);

namespace App\Component;

class EntityNotFoundException extends \RuntimeException
{
    public function __construct($message = '', $code = 404)
    {
        parent::__construct($message, $code);
    }
}
