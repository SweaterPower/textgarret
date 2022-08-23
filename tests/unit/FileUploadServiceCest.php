<?php

namespace app\tests\unit;

use app\models\FileData;
use app\models\forms\SavedFileForm;
use app\models\TextFile;
use app\services\fileUpload\FileUploadServiceInterface;
use app\tests\fixtures\FileDataFixture;
use app\tests\fixtures\FileFormatFixture;
use app\tests\fixtures\SizeTypeFixture;
use app\tests\fixtures\TextFileFixture;
use app\tests\fixtures\WordCountTypeFixture;
use UnitTester;
use Yii;
use yii\base\InvalidConfigException;

class FileUploadServiceCest
{
    protected FileUploadServiceInterface $fileUploadService;

    /**
     * @throws InvalidConfigException
     */
    public function _before(UnitTester $I): void
    {
        $this->fileUploadService = Yii::createObject(FileUploadServiceInterface::class);

        $I->haveFixtures([
            'sizeType' => SizeTypeFixture::class,
            'wordCountType' => WordCountTypeFixture::class,
            'fileFormat' => FileFormatFixture::class,
            'fileData' => FileDataFixture::class,
            'textFile' => TextFileFixture::class,
        ]);
    }

    public function testSuccess(UnitTester $I): void
    {
        $data = [
            'name' => 'test',
            'extension' => 'txt',
            'mimeType' => 'text/plain',
            'directory' => '@data/files/',
            'code' => 'test',
        ];

        $savedFileForm = new SavedFileForm($data);

        $I->assertTrue($savedFileForm->validate());

        $result = $this->fileUploadService->handle($savedFileForm);

        $I->assertTrue($result);

        $I->seeRecord(TextFile::class, ['code' => 'test']);

        /** @var TextFile $textFile */
        $textFile = $I->grabRecord(TextFile::class, ['code' => 'test']);
        $I->seeRecord(FileData::class, ['id' => $textFile->file_data_id]);
    }
}
