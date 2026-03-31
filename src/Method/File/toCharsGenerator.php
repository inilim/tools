<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @todo tests rename
 * @deprecated use toCharsGenerator_v2()
 * @ext mbstring
 * @author Inilim
 * @return \Generator<array{iter:int,posFrom:int,posTo:int},string>
 * @throws \InvalidArgumentException
 * @throws \Exception
 */
function toCharsGenerator(string $pathToFile, int $chunk = 1): \Generator
{
    \Inilim\Tool\Method\Assert\extPhp('mbstring');
    \Inilim\Tool\Method\Assert\file($pathToFile);
    \Inilim\Tool\Method\Assert\positiveInteger($chunk);
    $resource = \Inilim\Tool\Method\File\phpfopen($pathToFile, 'r');

    if ($resource === false) {
        throw new \Exception(\sprintf('Failed open file: "%s"', $pathToFile));
    }

    $iteration = 0;
    while (true) {

        $r = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function () use (&$iteration, $resource, $chunk) {
            $posFrom = \ftell($resource); // берем текущую позицию/указатель
            if ($posFrom === false) {
                return null;
            }

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            $chars = \fread($resource, (10 * $chunk));
            if ($chars === false) {
                return null;
            }
            $chars = \mb_substr($chars, 0, $chunk, 'UTF-8'); // из кусочка берем один символ
            \fseek($resource, ($posFrom + \strlen($chars))); // возвращаемся назад до того символна что взяли

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            $posTo = \ftell($resource); // берем текущую позицию/указатель
            if ($posTo === false) {
                return null;
            }

            if ($posFrom === $posTo) {
                return null;
            }

            return [[
                'iter'    => $iteration,
                'posFrom' => $posFrom,
                'posTo'   => $posTo,
            ], $chars];
        });

        if ($r === null) {
            break;
        }

        yield $r[0] => $r[1];

        $iteration++;
    }

    \Inilim\Tool\Method\File\phpfclose($resource);
}
