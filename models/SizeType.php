<?php

namespace app\models;

use app\models\query\SizeTypeQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "size_types".
 *
 * @property int $id
 * @property string $code [varchar(10)]
 * @property int $lower_value [int]
 *
 * @property FileData[] $fileData
 */
class SizeType extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'size_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['code'], 'required'],
            [['code'], 'string', 'max' => 10],
            [['lower_value'], 'integer', 'min' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
        ];
    }

    /**
     * Gets query for [[FileData]].
     *
     * @return ActiveQuery
     */
    public function getFileData(): ActiveQuery
    {
        return $this->hasMany(FileData::class, ['size_type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SizeTypeQuery the active query used by this AR class.
     */
    public static function find(): SizeTypeQuery
    {
        return new SizeTypeQuery(static::class);
    }
}
