<?php

use kartik\date\DatePicker;
use yii\grid\ActionColumn;
use yii\grid\SerialColumn;
use app\controllers\SiteController;
use app\dictionaries\SizeTypesDict;
use app\dictionaries\WordCountTypesDict;
use app\models\forms\FileUploadForm;
use app\models\search\TextFileSearch;
use app\models\TextFile;
use yii\bootstrap4\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var FileUploadForm $fileUploadForm
 * @var string $fileUploadAction
 * @var ActiveDataProvider $filesDataProvider
 * @var TextFileSearch $filesSearchModel
 * @var array $sizeTypeNames
 * @var array $wordCountTypeNames
 * @var array $fileFormats
 */

$this->title = 'Textgarret';
?>
<div class="site-index">

    <?php if (Yii::$app->session->hasFlash(SiteController::FILE_SAVE_RESULT_FLASH_KEY)) { ?>
        <div class="alert alert-dark" role="alert">
            <?= Yii::$app->session->getFlash(SiteController::FILE_SAVE_RESULT_FLASH_KEY) ?>
        </div>
    <?php } ?>

    <div class="jumbotron text-center bg-transparent">
        <?php
        $form = ActiveForm::begin();
        ?>

        <?= $form->field($fileUploadForm, 'textFile')->fileInput() ?>

        <?= Html::submitButton('Upload', ['class' => 'btn btn-secondary']) ?>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="body-content">
        <?= GridView::widget([
            'dataProvider' => $filesDataProvider,
            'filterModel' => $filesSearchModel,
            'filterPosition' => GridView::FILTER_POS_HEADER,
            'columns' => [
                [
                        'class' => SerialColumn::class
                ],
                [
                        'class' => ActionColumn::class,
                        'template' => '{download} {delete}',
                        'buttons' =>  [
                                'download' => static function ($url, $model, $key) {
                                    return Html::a(
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
</svg>',
                                            Url::to(['download', 'code' => $model->code]),
                                        [
                                            'title' => 'Download',
                                            'aria-label' => 'Download',
                                            'data-pjax' => '0',
                                        ]
                                    );
                                },
                                'delete' => static function ($url, $model, $key) {
                                    return Html::a(
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg>',
                                        Url::to(['delete', 'code' => $model->code]),
                                        [
                                            'title' => 'Delete',
                                            'aria-label' => 'Delete',
                                            'data-pjax' => '0',
                                            'data-confirm' => 'Are you sure you want to delete this file?',
                                            'data-method' => 'post',
                                        ]
                                    );
                                },
                        ],
                ],
                [
                    'attribute' => 'filename',
                    'format' => 'text',
                ],
                [
                    'attribute' => 'upload_datetime',
                    'format' => [
                        'date',
                        'php:d-m-Y',
                    ],
                    'filter' => DatePicker::widget(
                        [
                            'model' => $filesSearchModel,
                            'language' => 'ru',
                            'attribute' => 'upload_datetime',
                            'options' => ['placeholder' => 'Select date ...'],
                            'pluginOptions' => [
                                'format' => 'dd-mm-yyyy',
                                'todayHighlight' => true,
                            ],
                            'type'=>DatePicker::TYPE_INPUT,
                        ]
                    ),
                ],
                [
                    'label' => 'Format',
                    'attribute' => 'fileData.fileFormat.name',
                    'filter' => $fileFormats,
                    'filterInputOptions' => [
                        'prompt' => 'all',
                        'class' => 'form-control',
                    ],
                ],
                [
                    'label' => 'File type',
                    'attribute' => 'fileData.fileFormat.mime_type',
                ],
                [
                    'label' => 'Size (bytes)',
                    'attribute' => 'fileData.size',
                ],
                [
                    'label' => 'Size type',
                    'attribute' => 'fileData.sizeType.code',
                    'value' => static function ($model) use ($sizeTypeNames) {
                        /* @var TextFile $model */
                        return $sizeTypeNames[$model->fileData->sizeType->code ?? SizeTypesDict::SIZE_TYPE_UNKOWN];
                    },
                    'filter' => $sizeTypeNames,
                    'filterInputOptions' => [
                        'prompt' => 'all',
                        'class' => 'form-control',
                    ],
                ],
                [
                    'label' => 'Word count',
                    'attribute' => 'fileData.word_count',
                ],
                [
                    'label' => 'Word count type',
                    'attribute' => 'fileData.wordCountType.code',
                    'value' => static function ($model) use ($wordCountTypeNames) {
                        /* @var TextFile $model */
                        return $wordCountTypeNames[$model->fileData->wordCountType->code ?? WordCountTypesDict::WORD_COUNT_TYPE_UNKOWN];
                    },
                    'filter' => $wordCountTypeNames,
                    'filterInputOptions' => [
                        'prompt' => 'all',
                        'class' => 'form-control',
                    ],
                ],
            ],
        ]) ?>
    </div>
</div>
