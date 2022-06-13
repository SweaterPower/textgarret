<?php

namespace app\services\fileAnalysis\dto;

class TextAnalysisResultDto
{
    private ?int $wordCount;

    /**
     * @return int|null
     */
    public function getWordCount(): ?int
    {
        return $this->wordCount;
    }

    /**
     * @param int|null $wordCount
     *
     * @return TextAnalysisResultDto
     */
    public function setWordCount(?int $wordCount): TextAnalysisResultDto
    {
        $this->wordCount = $wordCount;

        return $this;
    }
}