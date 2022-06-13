<?php

namespace app\services\fileUpload;

use app\services\fileUpload\input\FileUploadServiceInputInterface;

interface FileUploadServiceInterface
{
    public function handle(FileUploadServiceInputInterface $input): bool;
}