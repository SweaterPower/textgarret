<?php

namespace app\services\fileUpload\hydrate;

use app\services\fileUpload\dto\FileUploadDto;
use app\services\fileUpload\input\FileUploadServiceInputInterface;

class HydrateFileUploadDto
{
    public function hydrate(FileUploadServiceInputInterface $input): FileUploadDto
    {
        return (new FileUploadDto())
            ->setName($input->getName())
            ->setExtension($input->getExtension())
            ->setCode($input->getCode())
            ->setDirectory($input->getDirectory())
            ->setMimeType($input->getMimeType());
    }
}