<?php

namespace app\repositories\wordCountType;

use app\models\WordCountType;
use yii\db\conditions\SimpleCondition;

class WordCountTypeRepository implements WordCountTypeRepositoryInterface
{
    public function getByWordCountComparison(int $wordCount): ?WordCountType
    {
        return WordCountType::find()
            ->orderBy(['lower_value' => SORT_DESC])
            ->andWhere(new SimpleCondition('lower_value', '<=', $wordCount))
            ->one();
    }
}