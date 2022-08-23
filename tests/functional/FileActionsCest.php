<?php

namespace app\tests\functional;

use app\models\TextFile;
use app\tests\fixtures\FileDataFixture;
use app\tests\fixtures\FileFormatFixture;
use app\tests\fixtures\SizeTypeFixture;
use app\tests\fixtures\TextFileFixture;
use app\tests\fixtures\WordCountTypeFixture;
use FunctionalTester;
use Yii;

class FileActionsCest
{
    public function _before(FunctionalTester $I): void
    {
        $I->haveFixtures([
            'sizeType' => SizeTypeFixture::class,
            'wordCountType' => WordCountTypeFixture::class,
            'fileFormat' => FileFormatFixture::class,
            'fileData' => FileDataFixture::class,
            'textFile' => TextFileFixture::class,
        ]);
    }

    public function testSubmitEmpty(FunctionalTester $I): void
    {
        $I->amOnPage('/site/index');
        $I->submitForm('form', []);
        $I->see('Upload File cannot be blank.');
    }

    public function testUpload(FunctionalTester $I): void
    {
        $I->amOnPage('/site/index');
        $I->attachFile('form input[type=file]', 'files/test_big.txt');
        $I->submitForm('form', []);

        $I->seeCurrentUrlEquals('/site/index');

        $I->see('File was saved successfully');
//        $I->see('test_big.txt');
//
//        $I->seeRecord(TextFile::class, ['filename' => 'test_big']);
//
//        /** @var TextFile $textFile **/
//        $textFile = $I->grabRecord(TextFile::class, ['filename' => 'test_big']);
//        $filename = Yii::getAlias(Yii::$app->params['fileSavePath']) . $textFile->code . '.txt';
//        $I->assertFileExists($filename);
//        $I->assertTrue(unlink($filename));
    }

//    public function testDelete(FunctionalTester $I): void
//    {
//        $I->amOnPage('/site/index');
//        $I->click('a[title="Delete"]');
//
//        $I->seeCurrentUrlEquals('/site/index');
//
//        $I->see('File deleted');
//    }
}
