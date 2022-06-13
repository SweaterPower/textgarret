<?php

namespace app\dictionaries;

class SizeTypesDict
{
    const SIZE_TYPE_UNKOWN = 'st_unknown';
    const SIZE_TYPE_SMALL = 'st_small';
    const SIZE_TYPE_MEDIUM = 'st_medium';
    const SIZE_TYPE_LARGE = 'st_large';
    const SIZE_TYPE_GIANT = 'st_giant';

    public static function getSizeTypeNames(): array
    {
        return [
            self::SIZE_TYPE_UNKOWN => 'unknown',
            self::SIZE_TYPE_SMALL => 'small',
            self::SIZE_TYPE_MEDIUM => 'medium',
            self::SIZE_TYPE_LARGE => 'large',
            self::SIZE_TYPE_GIANT => 'giant',
        ];
    }
}