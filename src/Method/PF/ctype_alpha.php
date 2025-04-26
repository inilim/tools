<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * Returns TRUE if every character in text is a letter, FALSE otherwise.
 * @see https://php.net/ctype-alpha
 * @param mixed $text
 * @return bool
 */
function ctype_alpha($text)
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_alpha')) {
        return \ctype_alpha($text);
    }
    $cls = \Inilim\Tool\Method\PF\__resourceCache('ctype_alpha');
    /** @var \Closure $cls */
    return $cls($text);
}
