<?php

namespace app\tests\unit;

use app\models\SizeType;
use app\tests\fixtures\SizeTypeFixture;
use UnitTester;

class SizeTypeCest
{
    public function _before(UnitTester $I): void
    {
        $I->haveFixtures([
            'sizeType' => SizeTypeFixture::class,
        ]);
    }

    public function testCreate(UnitTester $I): void
    {
        $sizeType = new SizeType();

        $sizeType->code = 'test';
        $sizeType->lower_value = 12345;

        $I->assertTrue($sizeType->save());
    }

    public function testCreateEmpty(UnitTester $I): void
    {
        $sizeType = new SizeType();

        $I->assertFalse($sizeType->validate());
        $I->assertFalse($sizeType->save());
    }

    public function testDelete(UnitTester $I): void
    {
        /** @var SizeType $sizeType */
        $sizeType = $I->grabRecord(SizeType::class, ['id' => 1]);

        $I->assertNotNull($sizeType);
        $I->assertNotFalse($sizeType->delete());

        $I->dontSeeRecord(SizeType::class, ['id' => 1]);
    }

    public function testUpdate(UnitTester $I): void
    {
        /** @var SizeType $sizeType */
        $sizeType = $I->grabRecord(SizeType::class, ['id' => 1]);

        $I->assertNotNull($sizeType);

        $sizeType->code = 'test_code';

        $I->assertTrue($sizeType->save());
        $I->seeRecord(SizeType::class, ['code' => 'test_code']);
    }
}
