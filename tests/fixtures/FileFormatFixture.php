<?php

namespace app\tests\fixtures;

use app\models\FileFormat;
use yii\test\ActiveFixture;

class FileFormatFixture extends ActiveFixture
{
    public $modelClass = FileFormat::class;

    public $dataFile = '@data/file_format.php';
}