<?php

namespace app\services\fileAnalysis\dto;

class FileAnalysisDto
{
    private ?string $fileFullName = null;
    private ?string $fileExtension = null;
    private ?string $fileMimeType = null;

    /**
     * @return string|null
     */
    public function getFileFullName(): ?string
    {
        return $this->fileFullName;
    }

    /**
     * @param string|null $fileFullName
     *
     * @return FileAnalysisDto
     */
    public function setFileFullName(?string $fileFullName): FileAnalysisDto
    {
        $this->fileFullName = $fileFullName;

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
     * @param string|null $fileExtension
     *
     * @return FileAnalysisDto
     */
    public function setFileExtension(?string $fileExtension): FileAnalysisDto
    {
        $this->fileExtension = $fileExtension;

        return $this;
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
     *
     * @return FileAnalysisDto
     */
    public function setFileMimeType(?string $fileMimeType): FileAnalysisDto
    {
        $this->fileMimeType = $fileMimeType;

        return $this;
    }
}