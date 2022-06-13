<?php

namespace app\services\fileAnalysis\hydrate;

use app\services\fileAnalysis\dto\FileAnalysisDto;
use app\services\fileAnalysis\input\FileAnalysisServiceInputInterface;

class HydrateFileAnalysisDto
{
    public function hydrate(FileAnalysisServiceInputInterface $input): FileAnalysisDto
    {
        return (new FileAnalysisDto())
            ->setFileFullName($input->getFileFullName())
            ->setFileExtension($input->getFileExtension())
            ->setFileMimeType($input->getFileMimeType());
    }
}