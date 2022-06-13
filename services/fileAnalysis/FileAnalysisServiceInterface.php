<?php

namespace app\services\fileAnalysis;

use app\models\FileData;
use app\services\fileAnalysis\input\FileAnalysisServiceInputInterface;

interface FileAnalysisServiceInterface
{
    public function handle(FileAnalysisServiceInputInterface $input): FileData;
}