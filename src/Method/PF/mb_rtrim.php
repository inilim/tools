<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * @ext mbstring
 */
function mb_rtrim(string $string, ?string $characters = null, ?string $encoding = null): string
{
    if (\Inilim\Tool\Method\Check\php84()) {
        return \mb_rtrim($string, $characters, $encoding);
    }

    return \Inilim\Tool\Method\PF\__mb_internal_trim('{[%s]+$}Du', $string, $characters, $encoding, 'mb_rtrim');
}
