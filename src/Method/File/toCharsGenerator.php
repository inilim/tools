<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @todo tests rename
 * @ext mbstring
 * @author Inilim
 * @return \Generator<array{iter:int,posFrom:int,posTo:int},string>
 * @throws \Exception
 */
function toCharsGenerator(string $pathToFile, int $chunk = 1): \Generator
{
    if (!\is_file($pathToFile)) {
        throw new \Exception(\sprintf('Not found file: "%s"', $pathToFile));
    }

    $resource = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => \fopen($pathToFile, 'r'),
        null
    );
    /** @var resource|false $resource */

    if ($resource === false) {
        throw new \Exception(\sprintf('Failed open file: "%s"', $pathToFile));
    }

    $iteration = 0;
    while (true) {
        $posFrom = \ftell($resource); // берем текущую позицию/указатель
        // ---------------------------------------------
        // 
        // ---------------------------------------------

        $chars = \fread($resource, (10 * $chunk));
        if ($chars === false) {
            break;
        }
        $chars = \mb_substr($chars, 0, $chunk, 'UTF-8'); // из кусочка берем один символ
        \fseek($resource, ($posFrom + \strlen($chars))); // возвращаемся назад до того символна что взяли

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        $posTo = \ftell($resource); // берем текущую позицию/указатель

        if ($posFrom === $posTo) {
            break;
        }

        yield [
            'iter'    => $iteration,
            'posFrom' => $posFrom,
            'posTo'   => $posTo,
        ] => $chars;

        $iteration++;
    }

    \fclose($resource);
}
