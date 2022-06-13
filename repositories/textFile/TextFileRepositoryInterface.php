<?php

namespace app\repositories\textFile;

use app\models\TextFile;

interface TextFileRepositoryInterface
{
    public function getByCode(string $code): ?TextFile;
}