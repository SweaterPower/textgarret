<?php

use yii\db\Connection;

$host = getenv('TEST_MYSQL_HOST');
$db = getenv('TEST_MYSQL_DATABASE');
$user = getenv('TEST_MYSQL_USER');
$pass = getenv('TEST_MYSQL_PASSWORD');

return [
    'class' => Connection::class,
    'dsn' => "mysql:host={$host};dbname={$db}",
    'username' => $user,
    'password' => $pass,
    'charset' => 'utf8',
];
