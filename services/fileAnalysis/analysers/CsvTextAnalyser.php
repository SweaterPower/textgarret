<?php

namespace app\services\fileAnalysis\analysers;

class CsvTextAnalyser extends BaseTextAnalyser
{
    /**
     * @param resource $stream
     *
     * @return int
     */
    protected function streamCallback($stream): int
    {
        $line = fgetcsv($stream);

        if ($line && is_array($line)) {
            return count($line);
        }

        return 0;
    }
}