<?php

namespace Inilim\Tool\Method\String;

/**
 * @return \Closure(string &$string, int $chunk):\Generator<array{iter:int,pos:int},string>
 */
function toCharsGenerator()
{
    return static function (string &$string, int $chunk = 1) {
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
