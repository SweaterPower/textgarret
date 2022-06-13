<?php

namespace app\repositories\wordCountType;

use app\models\WordCountType;

interface WordCountTypeRepositoryInterface
{
    public function getByWordCountComparison(int $wordCount): ?WordCountType;
}