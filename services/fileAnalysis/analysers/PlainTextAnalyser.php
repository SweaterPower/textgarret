<?php

namespace app\services\fileAnalysis\analysers;

class PlainTextAnalyser extends BaseTextAnalyser
{
    /**
     * @param resource $stream
     *
     * @return int
     */
    protected function streamCallback($stream): int
    {
        $line = fgets($stream);

        if ($line) {
            return str_word_count($line);
        }

        return 0;
    }
}