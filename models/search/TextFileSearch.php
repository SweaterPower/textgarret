<?php

namespace app\models\search;

use app\models\TextFile;
use DateTime;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

class TextFileSearch extends TextFile
{
    public function attributes()
    {
        return array_merge(
            parent::attributes(),
            ['fileData.fileFormat.name', 'fileData.fileFormat.mime_type', 'fileData.size', 'fileData.sizeType.code', 'fileData.word_count', 'fileData.wordCountType.code']
        );
    }

    public function rules(): array
    {
        return [
            [['filename', 'code', 'file_data_id', 'upload_datetime', 'fileData.fileFormat.name', 'fileData.fileFormat.mime_type', 'fileData.size', 'fileData.sizeType.code', 'fileData.word_count', 'fileData.wordCountType.code'], 'safe'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = TextFile::find()
            ->joinWith(['fileData', 'fileData.fileFormat', 'fileData.sizeType', 'fileData.wordCountType']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $dataProvider->sort->attributes['fileData.fileFormat.name'] = [
            'asc' => ['file_formats.name' => SORT_ASC],
            'desc' => ['file_formats.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['fileData.fileFormat.mime_type'] = [
            'asc' => ['file_formats.mime_type' => SORT_ASC],
            'desc' => ['file_formats.mime_type' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['fileData.size'] = [
            'asc' => ['file_data.size' => SORT_ASC],
            'desc' => ['file_data.size' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['fileData.sizeType.code'] = [
            'asc' => ['size_types.code' => SORT_ASC],
            'desc' => ['size_types.code' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['fileData.word_count'] = [
            'asc' => ['file_data.word_count' => SORT_ASC],
            'desc' => ['file_data.word_count' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['fileData.wordCountType.code'] = [
            'asc' => ['word_count_types.code' => SORT_ASC],
            'desc' => ['word_count_types.code' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'filename', $this->getAttribute('filename')])
            ->andFilterWhere(['=', 'file_formats.name', $this->getAttribute('fileData.fileFormat.name')])
            ->andFilterWhere(['like', 'file_formats.mime_type', $this->getAttribute('fileData.fileFormat.mime_type')])
            ->andFilterWhere(['=', 'file_data.size', $this->getAttribute('fileData.size')])
            ->andFilterWhere(['=', 'size_types.code', $this->getAttribute('fileData.sizeType.code')])
            ->andFilterWhere(['=', 'file_data.word_count', $this->getAttribute('fileData.word_count')])
            ->andFilterWhere(['=', 'word_count_types.code', $this->getAttribute('fileData.wordCountType.code')]);

        if ($this->getAttribute('upload_datetime')) {
            $date = DateTime::createFromFormat('d-m-Y', $this->getAttribute('upload_datetime'))->format('Y-m-d');
            $query->andFilterWhere(['between', 'upload_datetime', $date . ' 00:00:00', $date . ' 23:59:59']);
        }

        return $dataProvider;
    }
}