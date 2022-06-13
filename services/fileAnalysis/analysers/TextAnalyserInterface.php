<?php

namespace app\services\fileAnalysis\analysers;

use app\services\fileAnalysis\dto\TextAnalysisResultDto;

interface TextAnalyserInterface
{
    public function analyse(): TextAnalysisResultDto;
}