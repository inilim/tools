<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * Хеширование файла на основе размера файла, начала содержимого и конца, экспериментальная альтернатива функции hash_file, дабы ускорить хеширование больших файлов
 * @author inilim
 * @return string
 * @throws \InvalidArgumentException
 * @throws \Exception
 */
function hashFile(
    string $algo,
    string $pathToFile,
    int $byteStart = 1024,
    int $byteEnd   = 1024,
    bool $binary   = false
) {
    if ($byteStart < 0 || $byteEnd < 0) {
        throw new \InvalidArgumentException('$byteStart and $byteEnd must be greater than 0');
    }

    if (!\is_file($pathToFile)) {
        throw new \InvalidArgumentException(\sprintf('Not found file: "%s"', $pathToFile));
    }

    $size = \filesize($pathToFile);

    if ($size === false) {
        throw new \Exception(\sprintf('Failed open file: "%s"', $pathToFile));
    }

    if ($size <= ($byteStart + $byteEnd)) {
        return \hash_file($algo, $pathToFile, $binary);
    }

    $resource = \fopen($pathToFile, 'r');

    if ($resource === false) {
        throw new \Exception(\sprintf('Failed open file: "%s"', $pathToFile));
    }

    $strStart = \fread($resource, $byteStart);
    \fseek($resource, $size - $byteEnd);
    $strEnd   = \fread($resource, $byteEnd);

    return \hash($algo, \serialize([$size, $strStart, $strEnd]), $binary);
}
