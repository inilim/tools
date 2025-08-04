<?php

declare(strict_types=1);

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

use Inilim\Tool\VD;
use Inilim\Tool\Arr;
use Inilim\Tool\Obj;
use Inilim\Tool\Str;
use Inilim\Tool\Xml;
use Inilim\Dump\Dump;
use Inilim\Tool\Data;
use Inilim\Tool\Enum;
use Inilim\Tool\File;
use Inilim\Tool\Json;
use Inilim\Tool\Path;
use Inilim\Tool\Refl;
use Inilim\Tool\Time;
use Inilim\Tool\Other;
use Inilim\Tool\Double;
use Inilim\Tool\Integer;

__include('Str\limit');

function put(string $pathToFile, string $data): bool
{
    $dir = \dirname($pathToFile);
    $tmp = $dir . \DIRECTORY_SEPARATOR . \uniqid('', true);

    try {
        $h = \fopen($tmp, 'x');
    } catch (\Throwable $e) {
        if (!\str_contains($e->getMessage(), 'File exists')) {
            return false;
        }

        $tmp = $dir . \DIRECTORY_SEPARATOR . \uniqid('', true);
        $h = \fopen($tmp, 'x');
    }

    if ($h === false) {
        @\unlink($tmp);
        return false;
    }
    \fwrite($h, $data);
    \fclose($h);

    if (\rename($tmp, $pathToFile) === false) {
        @\unlink($tmp);
        return false;
    }

    return true;
}
