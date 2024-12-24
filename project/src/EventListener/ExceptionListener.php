<?php

namespace App\EventListener;

use App\Component\EntityNotFoundException;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;

#[AsEventListener(event: 'kernel.exception')]
class ExceptionListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $response = new JsonResponse();

        if ($exception instanceof ValidationFailedException || $exception->getPrevious() instanceof ValidationFailedException) {
            $validationFailedException = ($exception instanceof ValidationFailedException)
                ? $exception
                : $exception->getPrevious();

            $errors = [];
            foreach ($validationFailedException->getViolations() as $violation) {
                $errors[] = [
                    'path' => $violation->getPropertyPath(),
                    'error' => $violation->getMessage()
                ];
            }
            
            $response->setData($errors);
            $response->setStatusCode(422);
        } else {
            $message = $exception->getMessage();
            $response->setData(['message' => $message]);

            if ($exception instanceof HttpExceptionInterface) {
                $response->setStatusCode($exception->getStatusCode());
                $response->headers->replace($exception->getHeaders());
            } elseif ($exception instanceof EntityNotFoundException) {
                $response->setStatusCode($exception->getCode());
            } else {
                $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        
        $event->setResponse($response);
    }
}
