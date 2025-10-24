<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * via php://temp
 * @author inilim
 * @todo tests
 * @return resource|false
 */
function resourceFromString(string $string)
{
    return \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function () use ($string) {
        $stream = \fopen('php://temp', 'r+');
        if ($string !== '') {
            \fwrite($stream, $string);
            \fseek($stream, 0);
        }
        return $stream;
    });
}
