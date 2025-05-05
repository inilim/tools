<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @return \Closure(string &$string, int $chunk):\Generator<array{iter:int,pos:int},string>
 */
function toCharsGenerator()
{
    if (\func_num_args() !== 0) {
        throw new \InvalidArgumentException('toCharsGenerator()(...) <-- The arguments were passed to the wrong place');
    }
    return static function (string &$string, int $chunk = 1): \Generator {
        $len = \mb_strlen($string, 'UTF-8');
        if ($len > 0) {
            $iteration = 0;
            for ($i = 0; $i < $len; ($i += $chunk)) {
                yield [
                    'iter' => $iteration,
                    'pos'  => $i,
                ] => \mb_substr($string, $i, $chunk, 'UTF-8');
                $iteration++;
            }
        }
    };
}
