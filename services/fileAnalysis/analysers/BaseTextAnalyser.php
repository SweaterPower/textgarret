<?php

namespace app\services\fileAnalysis\analysers;

use app\services\fileAnalysis\dto\TextAnalysisResultDto;
use Exception;
use Iterator;
use Throwable;

class BaseTextAnalyser implements TextAnalyserInterface
{
    public const DEFAULT_STREAM_MODE = 'rb';

    /**
     * @var resource $fileStream
     */
    private $fileStream;
    private string $fileFullPath;

    /**
     * @param string $fileFullPath
     */
    public function __construct(string $fileFullPath)
    {
        $this->fileFullPath = $fileFullPath;
    }

    /**
     * @throws Exception
     */
    public function analyse(): TextAnalysisResultDto
    {
        $this->openStream();

        if (empty($this->fileStream)) {
            throw new Exception('Failed to open stream.');
        }

        try {
            $iterator = $this->readStream();
            $result = 0;

            foreach ($iterator as $value) {
                $result += $value;
            }
        } catch (Throwable $e) {
            throw new Exception("Error reading stream: {$e->getMessage()}", 0, $e);
        }

        if (!$this->closeStream()) {
            throw new Exception('Failed to close stream.');
        }

        $textAnalysisResultDto = new TextAnalysisResultDto();
        $textAnalysisResultDto->setWordCount($result);

        return $textAnalysisResultDto;
    }

    protected function readStream(): Iterator
    {
        while(!feof($this->fileStream)) {
            yield $this->streamCallback($this->fileStream);
        }
    }

    /**
     * @param resource $stream
     *
     * @return int
     */
    protected function streamCallback($stream): int
    {
        return strlen(fgets($stream));
    }

    protected function openStream(): void
    {
        $this->fileStream = fopen($this->fileFullPath, self::DEFAULT_STREAM_MODE);
    }

    protected function closeStream(): bool
    {
        return fclose($this->fileStream);
    }
}