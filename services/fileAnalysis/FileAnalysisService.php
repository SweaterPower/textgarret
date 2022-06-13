<?php

namespace app\services\fileAnalysis;

use app\models\FileData;
use app\repositories\fileFormat\FileFormatRepository;
use app\repositories\fileFormat\FileFormatRepositoryInterface;
use app\repositories\sizeType\SizeTypeRepositoryInterface;
use app\repositories\wordCountType\WordCountTypeRepositoryInterface;
use app\services\fileAnalysis\factory\TextAnalyserFactory;
use app\services\fileAnalysis\hydrate\HydrateFileAnalysisDto;
use app\services\fileAnalysis\input\FileAnalysisServiceInputInterface;
use Exception;
use Throwable;
use Yii;
use yii\helpers\VarDumper;

class FileAnalysisService implements FileAnalysisServiceInterface
{
    private HydrateFileAnalysisDto $hydrateService;
    private TextAnalyserFactory $textAnalyserFactory;
    private FileFormatRepositoryInterface $fileFormatRepository;
    private WordCountTypeRepositoryInterface $wordCountTypeRepository;
    private SizeTypeRepositoryInterface $sizeTypeRepository;

    /**
     * @param HydrateFileAnalysisDto $hydrateService
     * @param FileFormatRepository $fileFormatRepository
     * @param TextAnalyserFactory $textAnalyserFactory
     * @param WordCountTypeRepositoryInterface $wordCountTypeRepository
     * @param SizeTypeRepositoryInterface $sizeTypeRepository
     */
    public function __construct(
        HydrateFileAnalysisDto $hydrateService,
        FileFormatRepositoryInterface $fileFormatRepository,
        TextAnalyserFactory $textAnalyserFactory,
        WordCountTypeRepositoryInterface $wordCountTypeRepository,
        SizeTypeRepositoryInterface $sizeTypeRepository
    ) {
        $this->hydrateService = $hydrateService;
        $this->fileFormatRepository = $fileFormatRepository;
        $this->textAnalyserFactory = $textAnalyserFactory;
        $this->wordCountTypeRepository = $wordCountTypeRepository;
        $this->sizeTypeRepository = $sizeTypeRepository;
    }

    /**
     * @throws Exception
     */
    public function handle(FileAnalysisServiceInputInterface $input): FileData
    {
        try {
            $fileAnalysisDto = $this->hydrateService->hydrate($input);

            $fileFormat = $this->fileFormatRepository->findOrCreate($fileAnalysisDto->getFileExtension(),
                $fileAnalysisDto->getFileMimeType());

            $textAnalyser = $this->textAnalyserFactory->getTextAnalyser($fileFormat->mime_type, $fileAnalysisDto->getFileFullName());
            $analysisResultDto = $textAnalyser->analyse();

            $fileData = new FileData();
            $fileData->file_format_id = $fileFormat->id;

            $fileData->word_count = $analysisResultDto->getWordCount();
            $fileData->word_count_type_id = $this->getWordCountTypeId($analysisResultDto->getWordCount());

            $fileSize = $this->getFileSize($fileAnalysisDto->getFileFullName());
            $fileData->size = $fileSize;
            $fileData->size_type_id = $this->getFileSizeTypeId($fileSize);
        } catch (Throwable $e) {
            Yii::debug(VarDumper::export($fileAnalysisDto));
            throw new Exception("Error occurred while analysing file: {$e->getMessage()}", 0, $e);
        }

        return $fileData;
    }

    private function getFileSize(string $fileFullName): int
    {
        return filesize($fileFullName) ?: 0;
    }

    private function getWordCountTypeId(int $wordCount): ?int
    {
        $wordCountType = $this->wordCountTypeRepository->getByWordCountComparison($wordCount);

        return $wordCountType->id ?? null;
    }

    private function getFileSizeTypeId(int $fileSize): ?int
    {
        $sizeType = $this->sizeTypeRepository->getBySizeComparison($fileSize);

        return $sizeType->id ?? null;
    }
}