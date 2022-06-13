<?php

namespace app\models;

use app\models\query\FileDataQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "file_data".
 *
 * @property int $id
 * @property int|null $size
 * @property int|null $word_count
 * @property int|null $file_format_id
 * @property int|null $size_type_id
 * @property int|null $word_count_type_id
 *
 * @property FileFormat $fileFormat
 * @property SizeType $sizeType
 * @property TextFile $textFile
 * @property WordCountType $wordCountType
 */
class FileData extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'file_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['size', 'word_count', 'file_format_id', 'size_type_id', 'word_count_type_id'], 'integer'],
            [['file_format_id'], 'exist', 'skipOnError' => true, 'targetClass' => FileFormat::class, 'targetAttribute' => ['file_format_id' => 'id']],
            [['size_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => SizeType::class, 'targetAttribute' => ['size_type_id' => 'id']],
            [['word_count_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WordCountType::class, 'targetAttribute' => ['word_count_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'size' => Yii::t('app', 'Size'),
            'word_count' => Yii::t('app', 'Word Count'),
            'file_format_id' => Yii::t('app', 'File Format'),
            'size_type_id' => Yii::t('app', 'Size Type'),
            'word_count_type_id' => Yii::t('app', 'Word Count Type'),
        ];
    }

    /**
     * Gets query for [[FileFormat]].
     *
     * @return ActiveQuery
     */
    public function getFileFormat(): ActiveQuery
    {
        return $this->hasOne(FileFormat::class, ['id' => 'file_format_id']);
    }

    /**
     * Gets query for [[SizeType]].
     *
     * @return ActiveQuery
     */
    public function getSizeType(): ActiveQuery
    {
        return $this->hasOne(SizeType::class, ['id' => 'size_type_id']);
    }

    /**
     * Gets query for [[TextFiles]].
     *
     * @return ActiveQuery
     */
    public function getTextFile(): ActiveQuery
    {
        return $this->hasOne(TextFile::class, ['file_data_id' => 'id']);
    }

    /**
     * Gets query for [[WordCountType]].
     *
     * @return ActiveQuery
     */
    public function getWordCountType(): ActiveQuery
    {
        return $this->hasOne(WordCountType::class, ['id' => 'word_count_type_id']);
    }

    /**
     * {@inheritdoc}
     * @return FileDataQuery the active query used by this AR class.
     */
    public static function find(): FileDataQuery
    {
        return new FileDataQuery(static::class);
    }
}
