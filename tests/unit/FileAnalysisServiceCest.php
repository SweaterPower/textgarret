<?php

namespace app\tests\unit;

use app\models\forms\FileAnalysisForm;
use app\services\fileAnalysis\FileAnalysisServiceInterface;
use app\tests\fixtures\FileDataFixture;
use app\tests\fixtures\FileFormatFixture;
use app\tests\fixtures\SizeTypeFixture;
use app\tests\fixtures\TextFileFixture;
use app\tests\fixtures\WordCountTypeFixture;
use Codeception\Example;
use UnitTester;
use Yii;
use yii\base\InvalidConfigException;

class FileAnalysisServiceCest
{
    protected FileAnalysisServiceInterface $fileAnalysisService;

    /**
     * @throws InvalidConfigException
     */
    public function _before(UnitTester $I): void
    {
        $this->fileAnalysisService = Yii::createObject(FileAnalysisServiceInterface::class);

        $I->haveFixtures([
            'sizeType' => SizeTypeFixture::class,
            'wordCountType' => WordCountTypeFixture::class,
            'fileFormat' => FileFormatFixture::class,
            'fileData' => FileDataFixture::class,
            'textFile' => TextFileFixture::class,
        ]);
    }

    /**
     * @dataProvider getFileDataProvider
     */
    public function testFileAnalysis(UnitTester $I, Example $example): void
    {
        $data = [
            'fileFullName' => Yii::getAlias('@data') . '/files/' . $example['input']['file_name'],
            'fileExtension' => $example['input']['file_extension'],
            'fileMimeType' => $example['input']['file_mime_type'],
        ];

        $fileAnalysisForm = new FileAnalysisForm($data);

        $I->assertTrue($fileAnalysisForm->validate());

        $fileData = $this->fileAnalysisService->handle($fileAnalysisForm);

        $I->assertEquals($example['output']['size'], $fileData->size);
        $I->assertEquals($example['output']['size_type_id'], $fileData->size_type_id);
        $I->assertEquals($example['output']['word_count'], $fileData->word_count);
        $I->assertEquals($example['output']['word_count_type_id'], $fileData->word_count_type_id);
        $I->assertEquals($example['output']['file_format_id'], $fileData->file_format_id);
    }

    private function getFileDataProvider(): array
    {
        return [
            [
                'input' => [
                    'file_name' => 'test.txt',
                    'file_extension' => 'txt',
                    'file_mime_type' => 'text/plain',
                ],
                'output' => [
                    'size' => 19,
                    'size_type_id' => 1,
                    'word_count' => 10,
                    'word_count_type_id' => 1,
                    'file_format_id' => 1,
                ],
            ],
            [
                'input' => [
                    'file_name' => 'test.csv',
                    'file_extension' => 'csv',
                    'file_mime_type' => 'text/csv',
                ],
                'output' => [
                    'size' => 19,
                    'size_type_id' => 1,
                    'word_count' => 10,
                    'word_count_type_id' => 1,
                    'file_format_id' => 2,
                ],
            ],
            [
                'input' => [
                    'file_name' => 'test.xml',
                    'file_extension' => 'xml',
                    'file_mime_type' => 'text/xml',
                ],
                'output' => [
                    'size' => 272,
                    'size_type_id' => 1,
                    'word_count' => 10,
                    'word_count_type_id' => 1,
                    'file_format_id' => 3,
                ],
            ],
            [
                'input' => [
                    'file_name' => 'test_big.txt',
                    'file_extension' => 'txt',
                    'file_mime_type' => 'text/plain',
                ],
                'output' => [
                    'size' => 10687710,
                    'size_type_id' => 3,
                    'word_count' => 1,
                    'word_count_type_id' => 1,
                    'file_format_id' => 1,
                ],
            ],
            [
                'input' => [
                    'file_name' => 'test_words.txt',
                    'file_extension' => 'txt',
                    'file_mime_type' => 'text/plain',
                ],
                'output' => [
                    'size' => 7499,
                    'size_type_id' => 1,
                    'word_count' => 1500,
                    'word_count_type_id' => 2,
                    'file_format_id' => 1,
                ],
            ],
        ];
    }
}
