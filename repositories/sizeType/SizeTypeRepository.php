<?php

namespace app\repositories\sizeType;

use app\models\SizeType;
use yii\db\conditions\SimpleCondition;

class SizeTypeRepository implements SizeTypeRepositoryInterface
{
    public function getBySizeComparison(int $fileSize): ?SizeType
    {
        return SizeType::find()
            ->orderBy(['lower_value' => SORT_DESC])
            ->andWhere(new SimpleCondition('lower_value', '<=', $fileSize))
            ->one();
    }
}