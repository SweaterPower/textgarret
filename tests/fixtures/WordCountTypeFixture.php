<?php

namespace app\tests\fixtures;

use app\models\WordCountType;
use yii\test\ActiveFixture;

class WordCountTypeFixture extends ActiveFixture
{
    public $modelClass = WordCountType::class;

    public $dataFile = '@data/word_count_type.php';
}