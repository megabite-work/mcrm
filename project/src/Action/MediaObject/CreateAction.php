<?php

namespace App\Action\MediaObject;

use App\Component\EntityNotFoundException;
use App\Entity\MediaObject;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MediaObjectRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CreateAction
{
    public const UPLOAD_DIR = 'media';

    public function __construct(
        private EntityManagerInterface $em,
        private MediaObjectRepository $repo
    ) {}

    public function __invoke(UploadedFile $file): MediaObject
    {
        $filePath = $this->upload($file);

        $entity = (new MediaObject())
            ->setFilePath($filePath);

        return $entity;
    }

    private function upload(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $safeFilename = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
            $originalFilename
        );

        $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

        try {
            $file->move(
                static::UPLOAD_DIR,
                $newFilename
            );
        } catch (FileException $e) {
            throw new EntityNotFoundException('Failed to upload file: ' . $e->getMessage(), 500);
        }

        return $newFilename;
    }
}
