<?php

namespace app\tests\fixtures;

use app\models\TextFile;
use yii\test\ActiveFixture;

class TextFileFixture extends ActiveFixture
{
    public $modelClass = TextFile::class;

    public $dataFile = '@data/text_file.php';
}