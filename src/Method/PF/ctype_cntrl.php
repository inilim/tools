<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * Returns TRUE if every character in text is a control character from the current locale, FALSE otherwise.
 * @see https://php.net/ctype-cntrl
 * @param mixed $text
 */
function ctype_cntrl($text): bool
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_cntrl')) {
        return \ctype_cntrl($text);
    }
    $cls = \Inilim\Tool\Method\PF\__resourceCache('ctype_cntrl');
    /** @var \Closure $cls */
    return $cls($text);
}
