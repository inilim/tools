<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @author inilim
 * as mb_str_split, without ext mbstring
 * @return \Generator<int,string>
 */
function split(string $string, int $length = 1): \Generator
{
    \Inilim\Tool\Method\Assert\positiveInteger($length);

    if ($string === '') {
        return;
    }

    $len = \strlen($string);
    $offset = 0;
    while (true) {
        \preg_match(
            '/.{' . $length . '}/us',
            $string,
            $matches,
            \PREG_OFFSET_CAPTURE,
            $offset
        );

        if ($matches === []) {

            if ($len > $offset) {
                yield \substr($string, $offset);
            }

            return;
        }

        [$substr, $pos] = $matches[0];

        yield $substr;

        $offset = $pos + \strlen($substr);
    }
}
