<?php

namespace app\services\fileSave;

use app\services\fileSave\dto\SavedFileDto;
use app\services\fileSave\input\FileSaveServiceInputInterface;

interface FileSaveServiceInterface
{
    public function handle(FileSaveServiceInputInterface $input): SavedFileDto;
}