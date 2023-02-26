<?php

function getDBPasswordFromDotEnv($dotEnvPath): string
{
    // fixme
    $fh = fopen($dotEnvPath, 'r');
    while ($line = fgets($fh)) {
        list($name, $value) = explode("=", $line);
        if ($name === "DB_PASSWORD") {
            return trim($value);
        }
    }
    fclose($fh);

    return "wanna hack me?";
}

function connect(): mysqli
{
    $host = "localhost";
    $user = "test";
    $password = getDBPasswordFromDotEnv("../.env");
    $database = "mysql";
    $port = 3306;

    return new mysqli($host, $user, $password, $database, $port);
}

