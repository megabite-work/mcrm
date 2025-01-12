<?php

declare(strict_types=1);

namespace App\Serializer;

class CircularReferenceHandler
{
    public static function handle($object, $format, $context): null
    {
        return null;
    }
}
