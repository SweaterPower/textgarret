<?php

namespace app\models\forms;

use app\services\fileUpload\input\FileUploadServiceInputInterface;
use Yii;
use yii\base\Model;

class SavedFileForm extends Model implements FileUploadServiceInputInterface
{
    private ?string $name = null;
    private ?string $extension = null;
    private ?string $code = null;
    private ?string $directory = null;
    private ?string $mimeType = null;

    public function rules(): array
    {
        return [
            [['name', 'extension', 'code', 'directory', 'mimeType'], 'required'],
            [['name', 'extension', 'code', 'directory', 'mimeType'], 'string'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name' => Yii::t('app', 'Saved File Name'),
            'extension' => Yii::t('app', 'Saved File Extension'),
            'code' => Yii::t('app', 'Saved File Code'),
            'directory' => Yii::t('app', 'Saved File Directory'),
            'mimeType' => Yii::t('app', 'Saved File Mime Type'),
        ];
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * @param string|null $extension
     */
    public function setExtension(?string $extension): void
    {
        $this->extension = $extension;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string|null
     */
    public function getDirectory(): ?string
    {
        return $this->directory;
    }

    /**
     * @param string|null $directory
     */
    public function setDirectory(?string $directory): void
    {
        $this->directory = $directory;
    }

    /**
     * @return string|null
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * @param string|null $mimeType
     */
    public function setMimeType(?string $mimeType): void
    {
        $this->mimeType = $mimeType;
    }
}