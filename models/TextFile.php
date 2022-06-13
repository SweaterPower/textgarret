<?php

namespace app\models;

use app\models\query\TextFileQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "text_file".
 *
 * @property int $id
 * @property string $filename
 * @property string $code
 * @property string|null $upload_datetime
 * @property int $file_data_id
 *
 * @property FileData $fileData
 */
class TextFile extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'text_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['filename', 'code', 'file_data_id'], 'required'],
            [['upload_datetime'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['file_data_id'], 'integer'],
            [['filename', 'code'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['file_data_id'], 'exist', 'skipOnEmpty' => true, 'targetClass' => FileData::class, 'targetAttribute' => ['file_data_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'filename' => Yii::t('app', 'Filename'),
            'code' => Yii::t('app', 'Code'),
            'upload_datetime' => Yii::t('app', 'Upload Datetime'),
            'file_data_id' => Yii::t('app', 'File Data'),
        ];
    }

    /**
     * Gets query for [[Data]].
     *
     * @return ActiveQuery
     */
    public function getFileData(): ActiveQuery
    {
        return $this->hasOne(FileData::class, ['id' => 'file_data_id']);
    }

    /**
     * {@inheritdoc}
     * @return TextFileQuery the active query used by this AR class.
     */
    public static function find(): TextFileQuery
    {
        return new TextFileQuery(static::class);
    }
}
