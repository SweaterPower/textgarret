<?php

use yii\log\FileTarget;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/test_db.php';
$services = require __DIR__ . '/services.php';

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@data' => '@app/tests/_data',
        '@files' => '@data/saved_files'
    ],
    'language' => 'en-US',
    'components' => [
        'db' => $db,
        'mailer' => [
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],
        'log' => [
            'traceLevel' => 0,// YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'logVars' => [],
                    'levels' => ['error', 'warning', 'trace'],
                ],
            ],
        ],
    ],
    'params' => $params,
    'container' => [
        'singletons' => $services,
    ],
];
