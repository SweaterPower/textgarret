<?php

namespace app\services\fileAnalysis\analysers;

class XmlTextAnalyser extends BaseTextAnalyser
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
            return str_word_count(strip_tags($line));
        }

        return 0;
    }
}