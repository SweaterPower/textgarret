<?php

namespace app\repositories\fileFormat;

use app\models\FileFormat;

interface FileFormatRepositoryInterface
{
    public function findOrCreate(string $extension, string $mimeType): ?FileFormat;

    public function getFormatsList(): array;
}