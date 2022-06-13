<?php

namespace app\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[FileFormat]].
 *
 * @see \app\models\FileFormat
 */
class FileFormatQuery extends ActiveQuery
{
    public function byExtension(string $extension): self
    {
        return $this->andWhere(['extension' => $extension]);
    }

    public function byMimeType(string $mimeType): self
    {
        return $this->andWhere(['mime_type' => $mimeType]);
    }
}
