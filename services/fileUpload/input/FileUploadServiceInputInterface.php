<?php

namespace app\services\fileUpload\input;

interface FileUploadServiceInputInterface
{
    public function getName(): ?string;

    public function getExtension(): ?string;

    public function getCode(): ?string;

    public function getDirectory(): ?string;

    public function getMimeType(): ?string;
}