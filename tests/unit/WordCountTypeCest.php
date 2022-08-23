<?php

namespace app\tests\unit;

use app\models\WordCountType;
use app\tests\fixtures\WordCountTypeFixture;
use UnitTester;

class WordCountTypeCest
{
    public function _before(UnitTester $I): void
    {
        $I->haveFixtures([
            'wordCountType' => WordCountTypeFixture::class,
        ]);
    }

    public function testCreate(UnitTester $I): void
    {
        $wordCountType = new WordCountType();

        $wordCountType->code = 'test';
        $wordCountType->lower_value = 12345;

        $I->assertTrue($wordCountType->save());
    }

    public function testCreateEmpty(UnitTester $I): void
    {
        $wordCountType = new WordCountType();

        $I->assertFalse($wordCountType->validate());
        $I->assertFalse($wordCountType->save());
    }

    public function testDelete(UnitTester $I): void
    {
        /** @var WordCountType $wordCountType */
        $wordCountType = $I->grabRecord(WordCountType::class, ['id' => 1]);

        $I->assertNotNull($wordCountType);
        $I->assertNotFalse($wordCountType->delete());

        $I->dontSeeRecord(WordCountType::class, ['id' => 1]);
    }

    public function testUpdate(UnitTester $I): void
    {
        /** @var WordCountType $wordCountType */
        $wordCountType = $I->grabRecord(WordCountType::class, ['id' => 1]);

        $I->assertNotNull($wordCountType);

        $wordCountType->code = 'test_code';

        $I->assertTrue($wordCountType->save());
        $I->seeRecord(WordCountType::class, ['code' => 'test_code']);
    }
}
