<?php

namespace app\services\fileSave\input;

use yii\web\UploadedFile;

interface FileSaveServiceInputInterface
{
    public function getTemporaryFile(): ?UploadedFile;

    public function getName(): ?string;

    public function getExtension(): ?string;

    public function getMimeType(): ?string;
}