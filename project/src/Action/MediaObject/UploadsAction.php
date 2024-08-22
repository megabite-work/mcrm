<?php

namespace App\Action\MediaObject;

use App\Action\MediaObject\UploadAction;
use App\Component\EntityNotFoundException;

class UploadsAction
{
    public function __construct(
        private UploadAction $action
    ) {}

    public function __invoke(array $files): array
    {
        $files = $this->validate($files);
        $filePaths = [];

        foreach ($files as $file) {
            $filePaths[] = $this->action->upload($file);
        }

        return $filePaths;
    }

    private function validate(array $files): array
    {
        $files = array_slice($files, 0, 6);

        foreach ($files as $file) {
            $ext = $file->guessExtension();
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getSize();

            if (!in_array($ext, $this->action::EXTENSIONS)) {
                throw new EntityNotFoundException("Failed file extension on: $fileName", 400);
            }
            if ($fileSize > $this->action::SIZE) {
                throw new EntityNotFoundException("Failed file size on: $fileName", 400);
            }
        }

        return $files;
    }
}
