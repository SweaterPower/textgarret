<?php

namespace app\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\TextFile]].
 *
 * @see \app\models\TextFile
 */
class TextFileQuery extends ActiveQuery
{
    public function byCode(string $code): self
    {
        return $this->andWhere(['code' => $code]);
    }
}
