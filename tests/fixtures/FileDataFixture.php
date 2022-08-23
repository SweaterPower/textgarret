<?php

namespace app\tests\fixtures;

use app\models\FileData;
use yii\test\ActiveFixture;

class FileDataFixture extends ActiveFixture
{
    public $modelClass = FileData::class;

    public $dataFile = '@data/file_data.php';
}