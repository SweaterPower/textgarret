<?php

use yii\debug\Module;
use yii\gii\Module as GiiModule;
use yii\log\FileTarget;
use yii\swiftmailer\Mailer;
use app\models\User;
use yii\caching\FileCache;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$services = require __DIR__ . '/services.php';

$config = [
    'name' => 'Textgarret',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@files' => '@app/' . getenv('FILES_DIRECTORY'),
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => '318bbdddd6734a46aff79706d8960864',
        ],
        'cache' => [
            'class' => FileCache::class,
        ],
        'user' => [
            'identityClass' => User::class,
        ],
        'errorHandler' => [],
        'mailer' => [
            'class' => Mailer::class,
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'container' => [
      'singletons' => $services,
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => Module::class,
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => GiiModule::class,
        'allowedIPs' => ['*'],
    ];
}

return $config;
