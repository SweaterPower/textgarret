<?php

namespace app\services\fileSave\hydrate;

use app\services\fileSave\dto\TemporaryFileDto;
use app\services\fileSave\input\FileSaveServiceInputInterface;

class HydrateTemporaryFileDto
{
    public function hydrate(FileSaveServiceInputInterface $input): TemporaryFileDto
    {
        return (new TemporaryFileDto())
            ->setTemporaryFile($input->getTemporaryFile())
            ->setFileName($input->getName())
            ->setFileExtension($input->getExtension())
            ->setFileMimeType($input->getMimeType());
    }
}