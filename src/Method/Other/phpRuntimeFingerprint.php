<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * Возвращает отпечаток текущего PHP-рантайма.
 *
 * Учитывает всё, что влияет на конфигурацию исполнения:
 *  - SAPI (cli, fpm-fcgi, apache2handler, ...)
 *  - путь к бинарнику
 *  - версию PHP
 *  - загруженный php.ini и просканированные доп. .ini
 */
function phpRuntimeFingerprint(): string
{
    $scanned = \php_ini_scanned_files();
    return \sha1(\implode('|', [
        // 

        \PHP_SAPI,
        \PHP_BINARY,
        \PHP_VERSION_ID,
        (string) \php_ini_loaded_file(),
        false === $scanned ? '' : $scanned,

        // 
    ]), false);
}
