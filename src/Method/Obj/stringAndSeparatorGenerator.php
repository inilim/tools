<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @author inilim
 * @return \Generator<int,string>
 */
function stringAndSeparatorGenerator(string $string, string $separator): \Generator
{
    \Inilim\Tool\Method\Assert\stringNotEmpty($separator);
    if ($string === '') {
        return;
    }
    $offset = \strlen($separator);

    while (true) {
        $pos = \strpos($string, $separator);

        if ($pos === false) {
            // last item
            yield $string;
            return;
        }

        $item = \substr($string, 0, $pos);
        $string = \substr($string, \strlen($item) + $offset);

        yield $item;
    }
}
