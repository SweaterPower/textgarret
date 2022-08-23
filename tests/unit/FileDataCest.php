<?php

namespace app\tests\unit;

use app\models\FileData;
use app\tests\fixtures\FileDataFixture;
use app\tests\fixtures\FileFormatFixture;
use app\tests\fixtures\SizeTypeFixture;
use app\tests\fixtures\WordCountTypeFixture;
use UnitTester;

class FileDataCest
{
    public function _before(UnitTester $I): void
    {
        $I->haveFixtures([
            'sizeType' => SizeTypeFixture::class,
            'wordCountType' => WordCountTypeFixture::class,
            'fileFormat' => FileFormatFixture::class,
            'fileData' => FileDataFixture::class,
        ]);
    }

    public function testCreate(UnitTester $I): void
    {
        $fileData = new FileData();

        $fileData->size = 10240;
        $fileData->word_count = 1000;
        $fileData->size_type_id = 2;
        $fileData->word_count_type_id = 2;
        $fileData->file_format_id = 1;

        $I->assertTrue($fileData->save());
    }

    public function testDelete(UnitTester $I): void
    {
        /** @var FileData $fileData */
        $fileData = $I->grabRecord(FileData::class, ['id' => 1]);

        $I->assertNotNull($fileData);
        $I->assertNotFalse($fileData->delete());

        $I->dontSeeRecord(FileData::class, ['id' => 1]);
    }

    public function testUpdate(UnitTester $I): void
    {
        /** @var FileData $fileData */
        $fileData = $I->grabRecord(FileData::class, ['id' => 1]);

        $I->assertNotNull($fileData);

        $fileData->size = 123456;

        $I->assertTrue($fileData->save());
        $I->seeRecord(FileData::class, ['size' => 123456]);
    }
}
