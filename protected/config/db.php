<?php

$dbname = 'twitter';
$username = 'root';
$password = 'root';

return array(
    'connectionString' => "mysql:host=localhost;dbname=$dbname",
    'emulatePrepare' => true,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',
    'enableProfiling'=>true,
    'enableParamLogging'=>true,
    'schemaCachingDuration'=>3600,
);