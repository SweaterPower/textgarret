<?php

use app\repositories\fileFormat\FileFormatRepository;
use app\repositories\fileFormat\FileFormatRepositoryInterface;
use app\repositories\sizeType\SizeTypeRepository;
use app\repositories\sizeType\SizeTypeRepositoryInterface;
use app\repositories\textFile\TextFileRepositoryInterface;
use app\repositories\textFile\TextFileRepository;
use app\repositories\wordCountType\WordCountTypeRepository;
use app\repositories\wordCountType\WordCountTypeRepositoryInterface;
use app\services\fileSave\FileSaveService;
use app\services\fileSave\FileSaveServiceInterface;
use app\services\fileUpload\FileUploadService;
use app\services\fileUpload\FileUploadServiceInterface;
use app\services\fileAnalysis\FileAnalysisServiceInterface;
use app\services\fileAnalysis\FileAnalysisService;

return [
    //repositories
    TextFileRepositoryInterface::class => TextFileRepository::class,
    FileFormatRepositoryInterface::class => FileFormatRepository::class,
    WordCountTypeRepositoryInterface::class => WordCountTypeRepository::class,
    SizeTypeRepositoryInterface::class => SizeTypeRepository::class,

    //actual services
    FileUploadServiceInterface::class => FileUploadService::class,
    FileSaveServiceInterface::class => FileSaveService::class,
    FileAnalysisServiceInterface::class => FileAnalysisService::class,
];