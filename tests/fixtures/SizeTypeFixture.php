<?php

namespace app\tests\fixtures;

use app\models\SizeType;
use yii\test\ActiveFixture;

class SizeTypeFixture extends ActiveFixture
{
    public $modelClass = SizeType::class;

    public $dataFile = '@data/size_type.php';
}