<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * @param mixed $text
 * @return bool
 */
function ctype_lower($text)
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_lower')) {
        return \ctype_lower($text);
    }
    $cls = \Inilim\Tool\Method\PF\__resourceCache('ctype_lower');
    /** @var \Closure $cls */
    return $cls($text);
}
