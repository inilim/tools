<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * via create file
 * @author inilim
 * @todo tests
 * @return resource|false
 */
function resourceFromString_m3(string $string)
{
    return \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function () use ($string) {
        $ptf = \sys_get_temp_dir() . '/inilim-tools-' . \Inilim\Tool\Method\ID\uuidv4() . '.tmp';
        $stream = \fopen($ptf, 'w+');
        if ($stream === false) {
            return false;
        }
        if ($string !== '') {
            \fwrite($stream, $string);
            \fseek($stream, 0);
        }
        return $stream;
    });
}
