<?php

namespace app\tests\unit;

use app\models\TextFile;
use app\tests\fixtures\FileDataFixture;
use app\tests\fixtures\FileFormatFixture;
use app\tests\fixtures\SizeTypeFixture;
use app\tests\fixtures\TextFileFixture;
use app\tests\fixtures\WordCountTypeFixture;
use UnitTester;

class TextFileCest
{
    public function _before(UnitTester $I): void
    {
        $I->haveFixtures([
            'sizeType' => SizeTypeFixture::class,
            'wordCountType' => WordCountTypeFixture::class,
            'fileFormat' => FileFormatFixture::class,
            'fileData' => FileDataFixture::class,
            'textFile' => TextFileFixture::class,
        ]);
    }

    public function testCreate(UnitTester $I): void
    {
        $textFile = new TextFile();

        $textFile->filename = 'test_create_file_name';
        $textFile->code = 'test_create_file_code';
        $textFile->upload_datetime = date('Y-m-d H:i:s');
        $textFile->file_data_id = 1;

        $I->assertTrue($textFile->save());
    }

    public function testCreateEmpty(UnitTester $I): void
    {
        $textFile = new TextFile();

        $I->assertFalse($textFile->validate());
        $I->assertFalse($textFile->save());
    }

    public function testDelete(UnitTester $I): void
    {
        $textFile = TextFile::find()->byCode('test_file_code')->one();

        $I->assertNotNull($textFile);
        $I->assertNotFalse($textFile->delete());

        $I->dontSeeRecord(TextFile::class, ['code' => 'test_file_code']);
    }

    public function testUpdate(UnitTester $I): void
    {
        $textFile = TextFile::find()->byCode('test_file_code')->one();

        $I->assertNotNull($textFile);

        $textFile->code = 'test_file_new_code';

        $I->assertTrue($textFile->save());
        $I->seeRecord(TextFile::class, ['code' => 'test_file_new_code']);
    }
}
