<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Base\ListResponseDtoInterface;
use App\Validator\Exists;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    public function __construct(
        private ValidatorInterface $validator
    ) {}

    public function successResponse(object|array|null $content, int $status = Response::HTTP_OK): JsonResponse
    {
        $data = [
            'data' => $content ?? [],
        ];

        return $this->json($data, $status);
    }

    public function emptyResponse(int $status = Response::HTTP_NO_CONTENT): JsonResponse
    {
        return $this->json(data: [], status: $status);
    }

    public function indexResponse(ListResponseDtoInterface $data, int $status = Response::HTTP_OK): JsonResponse
    {
        return $this->json($data, $status);
    }

    public function errorResponse(array $errors = [], int $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $data = [
            'error' => $errors,
        ];

        return $this->json($data, $status);
    }

    public function validate(mixed $payload, Constraint|array|null $constraints = null): void
    {
        $fields = is_array($payload) ? $payload : [$payload];
        $constraints = is_array($constraints) ? $constraints : [$constraints];

        foreach ($fields as $key => $field) {
            $violations = $this->validator->validate($field, $constraints[$key] ?? null);
            if ($violations->count()) {
                throw new ValidationFailedException($field, $violations);
            }
        }
    }

    public function existsValidate(mixed $payload, array|string $entities, array|string|null $field = null): void
    {
        $columns = is_array($payload) ? $payload : [$payload];
        $entities = is_array($entities) ? $entities : [$entities];
        $fields = $field === null ? [null] : (is_array($field) ? $field : [$field]);

        foreach ($columns as $key => $column) {
            $violations = $this->validator->validate($column, new Exists($entities[$key], $fields[$key]));

            if ($violations->count()) {
                throw new ValidationFailedException($column, $violations);
            }
        }
    }
}
