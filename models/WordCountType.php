<?php

namespace app\models;

use app\models\query\WordCountTypeQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "word_count_types".
 *
 * @property int $id
 * @property string $code [varchar(10)]
 * @property int $lower_value [int]
 *
 * @property FileData[] $fileData
 */
class WordCountType extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'word_count_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['code'], 'required'],
            [['code'], 'string', 'max' => 255],
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
        return $this->hasMany(FileData::class, ['word_count_type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return WordCountTypeQuery the active query used by this AR class.
     */
    public static function find(): WordCountTypeQuery
    {
        return new WordCountTypeQuery(static::class);
    }
}
