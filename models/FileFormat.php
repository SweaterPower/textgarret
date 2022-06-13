<?php

namespace app\models;

use app\models\query\FileFormatQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "file_formats".
 *
 * @property int $id
 * @property string $name
 * @property string $extension
 * @property string $mime_type
 *
 * @property FileData[] $fileData
 */
class FileFormat extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'file_formats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'extension', 'mime_type'], 'required'],
            [['extension'], 'string', 'max' => 8],
            [['name', 'mime_type'], 'string', 'max' => 124],
            [['extension'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'extension' => Yii::t('app', 'Extension'),
            'mime_type' => Yii::t('app', 'Mime Type'),
        ];
    }

    /**
     * Gets query for [[FileData]].
     *
     * @return ActiveQuery
     */
    public function getFileData(): ActiveQuery
    {
        return $this->hasMany(FileData::class, ['file_format_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return FileFormatQuery the active query used by this AR class.
     */
    public static function find(): FileFormatQuery
    {
        return new FileFormatQuery(static::class);
    }
}
