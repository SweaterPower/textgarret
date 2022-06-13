<?php

namespace app\services\fileSave\dto;

use yii\web\UploadedFile;

class TemporaryFileDto
{
    private ?UploadedFile $temporaryFile = null;
    private ?string $fileName = null;
    private ?string $fileExtension = null;
    private ?string $fileCode = null;
    private ?string $fileSaveDirectory = null;
    private ?string $fileMimeType = null;

    /**
     * @return string|null
     */
    public function getFileMimeType(): ?string
    {
        return $this->fileMimeType;
    }

    /**
     * @param string|null $fileMimeType
     *
     * @return TemporaryFileDto
     */
    public function setFileMimeType(?string $fileMimeType): TemporaryFileDto
    {
        $this->fileMimeType = $fileMimeType;

        return $this;
    }

    /**
     * @param UploadedFile|null $temporaryFile
     *
     * @return TemporaryFileDto
     */
    public function setTemporaryFile(?UploadedFile $temporaryFile): TemporaryFileDto
    {
        $this->temporaryFile = $temporaryFile;

        return $this;
    }

    /**
     * @return UploadedFile|null
     */
    public function getTemporaryFile(): ?UploadedFile
    {
        return $this->temporaryFile;
    }

    /**
     * @param string|null $fileName
     *
     * @return TemporaryFileDto
     */
    public function setFileName(?string $fileName): TemporaryFileDto
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param string|null $fileExtension
     *
     * @return TemporaryFileDto
     */
    public function setFileExtension(?string $fileExtension): TemporaryFileDto
    {
        $this->fileExtension = $fileExtension;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFileExtension(): ?string
    {
        return $this->fileExtension;
    }

    /**
     * @param string|null $fileCode
     *
     * @return TemporaryFileDto
     */
    public function setFileCode(?string $fileCode): TemporaryFileDto
    {
        $this->fileCode = $fileCode;

        return $this;
}

    /**
     * @return string|null
     */
    public function getFileCode(): ?string
    {
        return $this->fileCode;
    }

    /**
     * @param string|null $fileSaveDirectory
     *
     * @return TemporaryFileDto
     */
    public function setFileSaveDirectory(?string $fileSaveDirectory): TemporaryFileDto
    {
        $this->fileSaveDirectory = $fileSaveDirectory;

        return $this;
}

    /**
     * @return string|null
     */
    public function getFileSaveDirectory(): ?string
    {
        return $this->fileSaveDirectory;
    }
}