<?php

namespace app\services\fileAnalysis\input;

interface FileAnalysisServiceInputInterface
{
    public function getFileFullName(): ?string;

    public function getFileExtension(): ?string;

    public function getFileMimeType(): ?string;
}