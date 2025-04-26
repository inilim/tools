<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * Returns TRUE if every character in text is either a letter or a digit, FALSE otherwise.
 * @see https://php.net/ctype-alnum
 * @param mixed $text
 * @return bool
 */
function ctype_alnum($text)
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_alnum')) {
        return \ctype_alnum($text);
    }
    $cls = \Inilim\Tool\Method\PF\__resourceCache('ctype_alnum');
    /** @var \Closure $cls */
    return $cls($text);
}
