<?php

namespace App\Action\MediaObject;

use App\Component\EntityNotFoundException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadAction
{
    public const UPLOAD_DIR = 'media';
    public const SIZE = 10485760; // 10 megabayt
    public const EXTENSIONS = ['png', 'jpg', 'jpeg', 'webp', 'pdf', 'xlsx', 'docx', 'doc', 'xls'];

    public function __invoke(UploadedFile $file): array
    {
        $filePath = $this->upload($file);

        return compact('filePath');
    }

    public function upload(UploadedFile $file): string
    {
        $newFilename = uniqid() . '.' . $file->guessExtension();

        try {
            $file->move(static::UPLOAD_DIR, $newFilename);
        } catch (FileException $e) {
            throw new EntityNotFoundException('Failed to upload file: ' . $e->getMessage(), 500);
        }

        return static::UPLOAD_DIR . '/' . $newFilename;
    }
}
