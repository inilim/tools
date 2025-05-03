<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * Returns TRUE if every character in the string text is a decimal digit, FALSE otherwise.
 * @see https://php.net/ctype-digit
 * @param mixed $text
 */
function ctype_digit($text): bool
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_digit')) {
        return \ctype_digit($text);
    }
    $cls = \Inilim\Tool\Method\PF\__resourceCache('ctype_digit');
    /** @var \Closure $cls */
    return $cls($text);
}
