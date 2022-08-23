<?php

namespace app\tests\unit;

use app\models\FileFormat;
use app\tests\fixtures\FileFormatFixture;
use UnitTester;

class FileFormatCest
{
    public function _before(UnitTester $I): void
    {
        $I->haveFixtures([
            'fileFormat' => FileFormatFixture::class,
        ]);
    }

    public function testCreate(UnitTester $I): void
    {
        $fileFormat = new FileFormat();

        $fileFormat->name = 'test';
        $fileFormat->extension = 'exte';
        $fileFormat->mime_type = 'text/test';

        $I->assertTrue($fileFormat->save());
    }

    public function testCreateEmpty(UnitTester $I): void
    {
        $fileFormat = new FileFormat();

        $I->assertFalse($fileFormat->validate());
        $I->assertFalse($fileFormat->save());
    }

    public function testDelete(UnitTester $I): void
    {
        /** @var FileFormat $fileFormat */
        $fileFormat = $I->grabRecord(FileFormat::class, ['id' => 1]);

        $I->assertNotNull($fileFormat);
        $I->assertNotFalse($fileFormat->delete());

        $I->dontSeeRecord(FileFormat::class, ['id' => 1]);
    }

    public function testUpdate(UnitTester $I): void
    {
        /** @var FileFormat $fileFormat */
        $fileFormat = $I->grabRecord(FileFormat::class, ['id' => 1]);

        $I->assertNotNull($fileFormat);

        $fileFormat->name = 'test_name';

        $I->assertTrue($fileFormat->save());
        $I->seeRecord(FileFormat::class, ['name' => 'test_name']);
    }
}
