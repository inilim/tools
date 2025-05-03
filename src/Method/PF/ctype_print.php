<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * @param mixed $text
 */
function ctype_print($text): bool
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_print')) {
        return \ctype_print($text);
    }
    $cls = \Inilim\Tool\Method\PF\__resourceCache('ctype_print');
    /** @var \Closure $cls */
    return $cls($text);
}
