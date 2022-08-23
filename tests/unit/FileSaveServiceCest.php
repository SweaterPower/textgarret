<?php

namespace app\tests\unit;

use app\models\forms\FileUploadForm;
use app\services\fileSave\FileSaveService;
use app\services\fileSave\FileSaveServiceInterface;
use app\services\fileSave\hydrate\HydrateTemporaryFileDto;
use UnitTester;
use Yii;
use yii\base\InvalidConfigException;
use yii\web\UploadedFile;

class FileSaveServiceCest
{
    protected FileSaveServiceInterface $fileSaveService;

    /**
     * @throws InvalidConfigException
     */
    public function _before(UnitTester $I): void
    {
        $this->fileSaveService = Yii::createObject(FileSaveServiceInterface::class);
    }

    public function testSuccess(UnitTester $I): void
    {
        $inputFilePath = Yii::getAlias('@data') . '/files/test.txt';
        $source = fopen($inputFilePath, 'rb');
        $config = [
            'name' => 'test.txt',
            'tempName' => $inputFilePath,
            'type' => 'text/plain',
            'size' => 126,
            'tempResource' => $source,
        ];

        $uploadedFile = new UploadedFile($config);

        $fileUploadForm = new FileUploadForm([
            'textFile' => $uploadedFile,
        ]);

        $I->assertTrue($fileUploadForm->validate());

        $savedFileDto = $this->fileSaveService->handle($fileUploadForm);

        $filename = Yii::getAlias(Yii::$app->params['fileSavePath']) . $savedFileDto->getCode() . '.' . $savedFileDto->getExtension();
        $I->assertFileExists($filename);
        $I->assertTrue(unlink($filename));

        $I->assertNotEmpty($savedFileDto->getCode());
        $I->assertEquals(Yii::$app->params['fileSavePath'], $savedFileDto->getDirectory());
        $I->assertEquals('txt', $savedFileDto->getExtension());
        $I->assertEquals('text/plain', $savedFileDto->getMimeType());
        $I->assertEquals('test', $savedFileDto->getName());
    }
}
