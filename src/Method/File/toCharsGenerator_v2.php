<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @todo rename
 * @ext mbstring
 * @author Inilim
 * @return \Closure():\Generator<array{iter:int,posFrom:int,posTo:int},string>
 * @throws \InvalidArgumentException
 * @throws \Exception
 */
function toCharsGenerator_v2(string $pathToFile, int $chunk = 1): \Closure
{
    \Inilim\Tool\Method\Assert\file($pathToFile);
    \Inilim\Tool\Method\Assert\positiveInteger($chunk);
    $resource = \Inilim\Tool\Method\File\phpfopen($pathToFile, 'r');

    if ($resource === false) {
        throw new \Exception(\sprintf('Failed open file: "%s"', $pathToFile));
    }

    return static function () use ($resource, $chunk) {
        /** @var resource $resource */

        $i = 0;

        $internal = static function () use (&$i, $resource, $chunk) {
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
                'iter'    => $i,
                'posFrom' => $posFrom,
                'posTo'   => $posTo,
            ], $chars];
        };

        while (true) {
            $r = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2($internal);
            if ($r === null) {
                break;
            }

            yield $r[0] => $r[1];
            $i++;
        } //endwhile

        \Inilim\Tool\Method\File\phpfclose($resource);
    };
}
