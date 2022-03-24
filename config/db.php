<?php

use yii\db\Connection;

$host = getenv('MYSQL_HOST');
$db = getenv('MYSQL_DATABASE');
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');

return [
    'class' => Connection::class,
    'dsn' => "mysql:host={$host};dbname={$db}",
    'username' => $user,
    'password' => $pass,
    'charset' => 'utf8',
];
