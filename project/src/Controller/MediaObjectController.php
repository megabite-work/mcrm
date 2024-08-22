<?php

namespace App\Controller;

use App\Entity\MediaObject;
use OpenApi\Attributes as OA;
use App\Action\MediaObject\CreateAction;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Attribute\MapUploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints as Assert;

#[Route(path: '/api/media-objects', format: 'json')]
#[OA\Tag(name: 'MediaObject')]
class MediaObjectController extends AbstractController
{
    #[Route(path: '', methods: ['POST'])]
    #[OA\Post(
        summary: 'Upload a file',
        requestBody: new OA\RequestBody(
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'file',
                            type: 'string',
                            format: 'binary',
                            description: 'The file to upload'
                        )
                    ]
                )
            ),
            required: true
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'File successfully uploaded.',
                content: new OA\JsonContent(
                    type: 'object',
                    ref: new Model(type: MediaObject::class, groups: ['media_object:show'])
                )
            ),
            new OA\Response(
                response: 400,
                description: 'File upload failed.',
                content: new OA\JsonContent(
                    type: 'string',
                    example: 'File upload failed.'
                )
            )
        ]
    )]
    public function create(#[MapUploadedFile(constraints: [new Assert\File(maxSize: '10M', extensions: ['png', 'jpg', 'jpeg', 'webp', 'ico', 'pdf', 'xlsx', 'docx', 'doc', 'xls'], groups: ['media_object:create_item'])], name: 'file')] UploadedFile $file, CreateAction $action): JsonResponse
    {
        // var_dump($file);
        // die;
        return $this->json($action($file));
    }
}
