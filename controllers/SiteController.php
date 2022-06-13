<?php

namespace app\controllers;

use app\dictionaries\SizeTypesDict;
use app\dictionaries\WordCountTypesDict;
use app\models\forms\FileUploadForm;
use app\models\forms\SavedFileForm;
use app\models\search\TextFileSearch;
use app\repositories\fileFormat\FileFormatRepositoryInterface;
use app\repositories\textFile\TextFileRepositoryInterface;
use app\services\fileSave\FileSaveServiceInterface;
use app\services\fileUpload\FileUploadServiceInterface;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    public const FILE_SAVE_RESULT_FLASH_KEY = 'file_save_result';

    public function actionDownload(string $code, TextFileRepositoryInterface $textFileRepository)
    {
        $textFile = $textFileRepository->getByCode($code);

        if ($textFile) {
            $fileDirectory = Yii::getAlias(Yii::$app->params['fileSavePath'] ?: null);
            $fileExtension = $textFile->fileData->fileFormat->extension ?? null;

            if ($fileDirectory && $fileExtension) {
                $fileFullName = $fileDirectory . $textFile->code . '.' . $fileExtension;

                if (file_exists($fileFullName)) {
                    return $this->response->sendFile($fileFullName, $textFile->filename . '.' . $fileExtension);
                }
            }
        }

        return ['error' => true];
    }

    public function actionIndex(
        Request $request, FileSaveServiceInterface $fileSaveService,
        FileUploadServiceInterface $fileUploadService, FileFormatRepositoryInterface $fileFormatRepository
    ) {
        if ($request->isPost) {
            Yii::$app->session->removeFlash(self::FILE_SAVE_RESULT_FLASH_KEY);

            $fileUploadForm = new FileUploadForm();
            $fileUploadForm->textFile = UploadedFile::getInstance($fileUploadForm, 'textFile');

            if ($fileUploadForm->validate()) {
                $savedFileDto = null;

                try {
                    $savedFileDto = $fileSaveService->handle($fileUploadForm);

                    $savedFileForm = new SavedFileForm();
                    $savedFileForm->name = $savedFileDto->getName();
                    $savedFileForm->extension = $savedFileDto->getExtension();
                    $savedFileForm->directory = $savedFileDto->getDirectory();
                    $savedFileForm->code = $savedFileDto->getCode();
                    $savedFileForm->mimeType = $savedFileDto->getMimeType();

                    if (!$savedFileForm->validate()) {
                        Yii::debug(VarDumper::export($savedFileForm->getErrorSummary(true)));
                        throw new Exception('File save result is not valid');
                    }

                    if (!$fileUploadService->handle($savedFileForm)) {
                        throw new Exception('File upload failure');
                    }
                } catch (Throwable $e) {
                    if ($savedFileDto !== null) {
                        if (!unlink(Yii::getAlias(
                            $savedFileDto->getDirectory() . $savedFileDto->getCode() . '.' . $savedFileDto->getExtension()
                        ))) {
                            Yii::error("Failed to delete file after error: '{$e->getMessage()}'");
                        }
                    }

                    Yii::error("Error occurred while uploading file: '{$e->getMessage()}'");

                    Yii::$app->session->setFlash(self::FILE_SAVE_RESULT_FLASH_KEY, 'Error saving file, try again later');
                }

                Yii::$app->session->setFlash(self::FILE_SAVE_RESULT_FLASH_KEY, 'File was saved successfully');
            } else {
                Yii::debug(VarDumper::export($fileUploadForm->getErrorSummary(true)));
                Yii::$app->session->setFlash(self::FILE_SAVE_RESULT_FLASH_KEY, $fileUploadForm->getFirstError('textFile'));
            }
        }

        $searchModel = new TextFileSearch();
        $dataProvider = $searchModel->search($request->get());

        return $this->render('index', [
            'fileUploadForm' => new FileUploadForm(),
            'filesDataProvider' => $dataProvider,
            'filesSearchModel' => $searchModel,
            'sizeTypeNames' => SizeTypesDict::getSizeTypeNames(),
            'wordCountTypeNames' => WordCountTypesDict::getWordCountTypeNames(),
            'fileFormats' => $fileFormatRepository->getFormatsList(),
        ]);
    }

    public function actionDelete(string $code, TextFileRepositoryInterface $textFileRepository): Response
    {
        try {
            $textFile = $textFileRepository->getByCode($code);

            if ($textFile) {
                $fileDirectory = Yii::getAlias(Yii::$app->params['fileSavePath'] ?: null);
                $fileExtension = $textFile->fileData->fileFormat->extension ?? null;

                if ($fileDirectory && $fileExtension) {
                    $fileFullName = $fileDirectory . $textFile->code . '.' . $fileExtension;

                    if (file_exists($fileFullName) && unlink($fileFullName) && $textFile->delete()) {
                        Yii::$app->session->setFlash(self::FILE_SAVE_RESULT_FLASH_KEY, 'File deleted');
                    }
                }
            }
        } catch (Throwable $e) {
            Yii::error("Error occurred while deleting file: '{$e->getMessage()}'");
        }

        return $this->redirect(Url::to(['site/index']));
    }
}
