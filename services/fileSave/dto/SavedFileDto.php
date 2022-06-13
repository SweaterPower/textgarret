<?php

namespace app\services\fileSave\dto;

class SavedFileDto
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
     * @return SavedFileDto
     */
    public function setMimeType(?string $mimeType): SavedFileDto
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
     * @return SavedFileDto
     */
    public function setName(?string $name): SavedFileDto
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
     * @return SavedFileDto
     */
    public function setExtension(?string $extension): SavedFileDto
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
     * @return SavedFileDto
     */
    public function setCode(?string $code): SavedFileDto
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
     * @return SavedFileDto
     */
    public function setDirectory(?string $directory): SavedFileDto
    {
        $this->directory = $directory;

        return $this;
    }
}