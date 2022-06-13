<?php

namespace app\repositories\sizeType;

use app\models\SizeType;

interface SizeTypeRepositoryInterface
{
    public function getBySizeComparison(int $fileSize): ?SizeType;
}