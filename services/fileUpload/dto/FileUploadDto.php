<?php

namespace app\services\fileUpload\dto;

class FileUploadDto
{
    private ?string $name = null;
    private ?string $extension = null;
    private ?string $code = null;
    private ?string $directory = null;
    private ?string $mimeType = null;

    /**
     * @return string|null
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * @param string|null $mimeType
     *
     * @return FileUploadDto
     */
    public function setMimeType(?string $mimeType): FileUploadDto
    {
        $this->mimeType = $mimeType;

        return $this;
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
     *
     * @return FileUploadDto
     */
    public function setName(?string $name): FileUploadDto
    {
        $this->name = $name;

        return $this;
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
     *
     * @return FileUploadDto
     */
    public function setExtension(?string $extension): FileUploadDto
    {
        $this->extension = $extension;

        return $this;
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
     *
     * @return FileUploadDto
     */
    public function setCode(?string $code): FileUploadDto
    {
        $this->code = $code;

        return $this;
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
     *
     * @return FileUploadDto
     */
    public function setDirectory(?string $directory): FileUploadDto
    {
        $this->directory = $directory;

        return $this;
    }
}