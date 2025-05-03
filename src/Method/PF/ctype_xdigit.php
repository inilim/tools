<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * @param mixed $text
 */
function ctype_xdigit($text): bool
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_xdigit')) {
        return \ctype_xdigit($text);
    }
    $cls = \Inilim\Tool\Method\PF\__resourceCache('ctype_xdigit');
    /** @var \Closure $cls */
    return $cls($text);
}
