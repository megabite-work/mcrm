<?php

namespace App\Dto\MediaObject;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class FileUploadDto
{
    public function __construct(
        #[Groups(['media_object:create_item'])]
        #[Assert\NotBlank(groups: ['media_object:create_item'])]
        #[Assert\File(
            maxSize: '10M',
            extensions: ['png', 'jpg', 'jpeg', 'webp', 'pdf', 'xlsx', 'docx', 'doc', 'xls'],
            groups: ['media_object:create_item']
        )]
        private UploadedFile $file,
    ) {}
}
