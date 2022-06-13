<?php

namespace app\repositories\fileFormat;

use app\dictionaries\FileMimeTypesDict;
use app\models\FileFormat;

class FileFormatRepository implements FileFormatRepositoryInterface
{
    public function findOrCreate(string $extension, string $mimeType): ?FileFormat
    {
        $fileFormat = FileFormat::find()->byExtension($extension)->one();

        if (!$fileFormat) {
            $fileFormat = new FileFormat();
            $fileFormat->extension = $extension;
            $fileFormat->mime_type = $mimeType;

            $fileFormat->name = FileMimeTypesDict::getMimeTypeNames()[$mimeType] ?? null;
            if (!$fileFormat->name) {
                $mimeTypeSplit = explode('/', $mimeType);
                $fileFormat->name = array_pop($mimeTypeSplit);
            }

            if (!$fileFormat->save()) {
                return null;
            }
        }

        return $fileFormat;
    }

    public function getFormatsList(): array
    {
        return FileFormat::find()->select('name')->asArray()->indexBy('name')->column();
    }
}