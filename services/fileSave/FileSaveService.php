<?php

namespace app\services\fileSave;

use app\services\fileSave\dto\SavedFileDto;
use app\services\fileSave\dto\TemporaryFileDto;
use app\services\fileSave\hydrate\HydrateTemporaryFileDto;
use app\services\fileSave\input\FileSaveServiceInputInterface;
use Exception;
use Throwable;
use Yii;
use yii\helpers\VarDumper;

class FileSaveService implements FileSaveServiceInterface
{
    private HydrateTemporaryFileDto $hydrateService;

    public function __construct(
        HydrateTemporaryFileDto $hydrateService
    ) {
        $this->hydrateService = $hydrateService;
    }

    /**
     * @throws Exception
     */
    public function handle(FileSaveServiceInputInterface $input): SavedFileDto
    {
        $temporaryFileDto = $this->hydrateService->hydrate($input);

        $temporaryFileDto->setFileCode($this->generateFileCode());
        $temporaryFileDto->setFileSaveDirectory(Yii::$app->params['fileSavePath'] ?: null);

        $this->saveFile($temporaryFileDto);

        return $this->fillSavedFileDto($temporaryFileDto);
    }

    /**
     * @throws Exception
     */
    private function generateFileCode(): string
    {
        $bytes = random_bytes(5);
        return bin2hex($bytes);
    }

    /**
     * @throws Exception
     */
    private function saveFile(TemporaryFileDto $dto): void
    {
        try {
            if (!$dto->getTemporaryFile()) {
                throw new Exception('Uploaded file object is empty');
            }

            if (empty($dto->getFileSaveDirectory())) {
                throw new Exception('File save destination directory is empty');
            }

            if (empty($dto->getFileCode())) {
                throw new Exception('File code is empty');
            }

            $fileFullName = $dto->getFileSaveDirectory() . $dto->getFileCode() . '.' . $dto->getFileExtension();

            try {
                $result = $dto->getTemporaryFile()->saveAs($fileFullName);
            } catch (Throwable $e) {
                Yii::debug(VarDumper::export($fileFullName));
                throw new Exception('Failed to write permanent file: ' . $e->getMessage(), 0, $e);
            }

            if (!$result) {
                throw new Exception("Failed to save uploaded file");
            }
        } catch (Throwable $e) {
            Yii::debug(VarDumper::export($dto));
            throw new Exception("Error occurred while saving file to filesystem: {$e->getMessage()}", 0, $e);
        }
    }

    private function fillSavedFileDto(TemporaryFileDto $dto): SavedFileDto
    {
        return (new SavedFileDto())
            ->setName($dto->getFileName())
            ->setExtension($dto->getFileExtension())
            ->setDirectory($dto->getFileSaveDirectory())
            ->setCode($dto->getFileCode())
            ->setMimeType($dto->getFileMimeType());
    }
}