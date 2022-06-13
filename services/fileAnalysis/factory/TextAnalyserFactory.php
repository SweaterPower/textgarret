<?php

namespace app\services\fileAnalysis\factory;

use app\dictionaries\FileMimeTypesDict;
use app\services\fileAnalysis\analysers\BaseTextAnalyser;
use app\services\fileAnalysis\analysers\CsvTextAnalyser;
use app\services\fileAnalysis\analysers\PlainTextAnalyser;
use app\services\fileAnalysis\analysers\TextAnalyserInterface;
use app\services\fileAnalysis\analysers\XmlTextAnalyser;

class TextAnalyserFactory
{
    public function getTextAnalyser(string $mimeType, string $fileFullName): TextAnalyserInterface
    {
        switch ($mimeType) {
            case (FileMimeTypesDict::MIME_TYPE_TEXT_CSV):
                return new CsvTextAnalyser($fileFullName);

            case (FileMimeTypesDict::MIME_TYPE_TEXT_XML):
                return new XmlTextAnalyser($fileFullName);

            case (FileMimeTypesDict::MIME_TYPE_TEXT_PLAIN):
                return new PlainTextAnalyser($fileFullName);

            default:
                return new BaseTextAnalyser($fileFullName);
        }
    }
}