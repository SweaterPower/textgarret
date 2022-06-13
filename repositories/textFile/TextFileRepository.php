<?php

namespace app\repositories\textFile;

use app\models\TextFile;

class TextFileRepository implements TextFileRepositoryInterface
{
    public function getByCode(string $code): ?TextFile
    {
        return TextFile::find()->byCode($code)->one();
    }
}