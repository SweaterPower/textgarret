<?php

namespace app\models\forms;

use app\dictionaries\FileMimeTypesDict;
use app\services\fileSave\input\FileSaveServiceInputInterface;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class FileUploadForm extends Model implements FileSaveServiceInputInterface
{
    public ?UploadedFile $textFile = null;

    public function rules(): array
    {
        return [
            ['textFile', 'required'],
            [
                'textFile',
                'file',
                'maxSize' => 536870912,
                'mimeTypes' => FileMimeTypesDict::getAllowedMimeTypes(),
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'textFile' => 'Upload File',
        ];
    }

    public function getTemporaryFile(): ?UploadedFile
    {
        return $this->textFile;
    }

    public function getName(): ?string
    {
        return $this->textFile->getBaseName();
    }

    public function getExtension(): ?string
    {
        return $this->textFile->getExtension();
    }

    public function getMimeType(): ?string
    {
        return $this->textFile->type;
    }
}