<?php

namespace app\services\fileUpload;

use app\models\forms\FileAnalysisForm;
use app\models\TextFile;
use app\services\fileUpload\hydrate\HydrateFileUploadDto;
use app\services\fileUpload\input\FileUploadServiceInputInterface;
use app\services\fileAnalysis\FileAnalysisServiceInterface;
use Exception;
use Throwable;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\VarDumper;

class FileUploadService implements FileUploadServiceInterface
{
    private HydrateFileUploadDto $hydrateService;
    private FileAnalysisServiceInterface $textAnalysisService;

    public function __construct(
        HydrateFileUploadDto $hydrateService, FileAnalysisServiceInterface $textAnalysisService
    ) {
        $this->hydrateService = $hydrateService;
        $this->textAnalysisService = $textAnalysisService;
    }

    /**
     * @throws Exception
     */
    public function handle(FileUploadServiceInputInterface $input): bool
    {
        $fileUploadDto = $this->hydrateService->hydrate($input);

        $textFile = new TextFile();
        $textFile->filename = "{$fileUploadDto->getName()}.{$fileUploadDto->getExtension()}";
        $textFile->code = $fileUploadDto->getCode();
        $textFile->upload_datetime = date('Y-m-d H:i:s');

        $textAnalysisForm = new FileAnalysisForm();
        $textAnalysisForm->fileFullName = Yii::getAlias(
            $fileUploadDto->getDirectory() . $fileUploadDto->getCode() . '.' . $fileUploadDto->getExtension()
        );
        $textAnalysisForm->fileExtension = $fileUploadDto->getExtension();
        $textAnalysisForm->fileMimeType = $fileUploadDto->getMimeType();

        if (empty($textAnalysisForm->fileMimeType)) {
            $textAnalysisForm->fileMimeType = FileHelper::getMimeTypeByExtension($textAnalysisForm->fileFullName);
        }

        if ($textAnalysisForm->validate()) {
            $fileData = $this->textAnalysisService->handle($textAnalysisForm);
        } else {
            Yii::debug(VarDumper::export($textAnalysisForm->getErrorSummary(true)));
            throw new Exception("Failed to analyse file: file data is not valid. Filename: " . $textAnalysisForm->fileFullName ?? '');
        }

        $transaction = Yii::$app->db->beginTransaction();
        if ($transaction) {
            try {
                if (!$fileData->save()) {
                    Yii::debug(VarDumper::export($fileData->getErrorSummary(true)));
                    throw new Exception('Can not save file data for text file ' . $textFile->filename);
                }

                $textFile->file_data_id = $fileData->id;

                if (!$textFile->save()) {
                    Yii::debug(VarDumper::export($textFile->getErrorSummary(true)));
                    throw new Exception('Can not bind file data to text file ' . $textFile->filename);
                }
            } catch (Throwable $e) {
                $transaction->rollBack();
                throw new Exception("Error occurred while saving analysis results: {$e->getMessage()}", 0, $e);
            }

            $transaction->commit();

            return true;
        }

        throw new Exception('Failed to open database transaction');
    }
}