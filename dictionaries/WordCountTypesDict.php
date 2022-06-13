<?php

namespace app\dictionaries;

class WordCountTypesDict
{
    const WORD_COUNT_TYPE_UNKOWN = 'wc_unknown';
    const WORD_COUNT_TYPE_SMALL = 'wc_small';
    const WORD_COUNT_TYPE_MEDIUM = 'wc_medium';
    const WORD_COUNT_TYPE_LARGE = 'wc_large';
    const WORD_COUNT_TYPE_GIANT = 'wc_giant';

    public static function getWordCountTypeNames(): array
    {
        return [
            self::WORD_COUNT_TYPE_UNKOWN => 'unknown',
            self::WORD_COUNT_TYPE_SMALL => 'small',
            self::WORD_COUNT_TYPE_MEDIUM => 'medium',
            self::WORD_COUNT_TYPE_LARGE => 'large',
            self::WORD_COUNT_TYPE_GIANT => 'giant',
        ];
    }
}