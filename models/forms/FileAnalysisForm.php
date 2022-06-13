<?php

namespace app\models\forms;

use app\dictionaries\FileMimeTypesDict;
use app\services\fileAnalysis\input\FileAnalysisServiceInputInterface;
use Yii;
use yii\base\Model;
use yii\validators\InlineValidator;

class FileAnalysisForm extends Model implements FileAnalysisServiceInputInterface
{
    private ?string $fileFullName = null;
    private ?string $fileExtension = null;
    private ?string $fileMimeType = null;

    public function rules(): array
    {
        return [
            [['fileFullName', 'fileExtension', 'fileMimeType'], 'required'],
            [['fileFullName', 'fileExtension', 'fileMimeType'], 'string'],
            ['fileMimeType', 'in', 'range' => FileMimeTypesDict::getAllowedMimeTypes()],
            ['fileFullName', function ($attribute, $params, $validator) {
                /* @var InlineValidator $validator */
                if (!file_exists($this->$attribute)) {
                    $validator->addError($this, $attribute, "File that needs to be analysed does not exist");
                }
            }],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'fileFullName' => Yii::t('app', 'Text Analyser File Full Name'),
            'fileExtension' => Yii::t('app', 'Text Analyser File Extension'),
            'fileMimeType' => Yii::t('app', 'Text Analyser File Mime Type'),
        ];
    }

    /**
     * @return string|null
     */
    public function getFileFullName(): ?string
    {
        return $this->fileFullName;
    }

    /**
     * @param string|null $fileFullName
     */
    public function setFileFullName(?string $fileFullName): void
    {
        $this->fileFullName = $fileFullName;
    }

    /**
     * @return string|null
     */
    public function getFileExtension(): ?string
    {
        return $this->fileExtension;
    }

    /**
     * @param string|null $fileExtension
     */
    public function setFileExtension(?string $fileExtension): void
    {
        $this->fileExtension = $fileExtension;
    }

    /**
     * @return string|null
     */
    public function getFileMimeType(): ?string
    {
        return $this->fileMimeType;
    }

    /**
     * @param string|null $fileMimeType
     */
    public function setFileMimeType(?string $fileMimeType): void
    {
        $this->fileMimeType = $fileMimeType;
    }
}