<?php

declare(strict_types=1);

namespace App\Resolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;

class CamelCaseToSnakeCaseNameResolver implements ValueResolverInterface
{
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $argumentType = $argument->getType();
        
        if (
            !$argumentType
            || !in_array($argumentType, ['string', 'int', 'bool'])
            || !preg_match('/[A-Z]/', $argument->getName())
        ) {
            return [];
        }
        
        $snakeCase = strtolower(preg_replace('/[A-Z]/', '_$0', $argument->getName()));
        yield $request->attributes->get($snakeCase);
    }
}
