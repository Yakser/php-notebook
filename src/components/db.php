<?php

function loadDotEnv($dotEnvPath): array
{
    $store = [];
    $fh = fopen($dotEnvPath, 'r');
    while ($line = fgets($fh)) {
        list($name, $value) = explode("=", $line);
            $store[$name] = trim($value);
    }
    fclose($fh);
    return $store;
}



function connect(): array
{
    $store = loadDotEnv("../.env");
    return [new mysqli($store['DB_HOST'], $store['DB_USER'], $store['DB_PASSWORD'], $store['DB_NAME'], $store['DB_PORT']), $store['DB_SCHEMA']];
}

