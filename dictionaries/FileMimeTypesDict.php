<?php

namespace app\dictionaries;

class FileMimeTypesDict
{
    public const MIME_TYPE_TEXT_CSV = 'text/csv';
    public const MIME_TYPE_TEXT_XML = 'text/xml';
    public const MIME_TYPE_TEXT_PLAIN = 'text/plain';
    public const MIME_TYPE_TEXT_WILDCARD = 'text/*';

    public static function getAllowedMimeTypes(): array
    {
        return [
            self::MIME_TYPE_TEXT_CSV,
            self::MIME_TYPE_TEXT_XML,
            self::MIME_TYPE_TEXT_PLAIN,
        ];
    }

    public static function getMimeTypeNames(): array
    {
        return [
            self::MIME_TYPE_TEXT_CSV => 'csv',
            self::MIME_TYPE_TEXT_XML => 'xml',
            self::MIME_TYPE_TEXT_PLAIN => 'txt',
            self::MIME_TYPE_TEXT_WILDCARD => 'unknown'
        ];
    }
}