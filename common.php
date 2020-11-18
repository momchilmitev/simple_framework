<?php

session_start();
spl_autoload_register(function($class) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$template = new \Core\Template();
$dataBinder = new \Core\DataBinder();

$dbData= parse_ini_file("Config/db.ini");
$pdo = new PDO($dbData['dsn'], $dbData['user'], $dbData['pass']);

$db = new \Database\PDODatabase($pdo);
$userRepository = new \App\Repositories\UserRepository($db);
$encryptionService = new \App\Services\Encryption\ArgonService();
$userService = new \App\Services\UserService($userRepository, $encryptionService);
$userHttpHandler = new \App\Http\UserHttpHandler($template, $dataBinder);