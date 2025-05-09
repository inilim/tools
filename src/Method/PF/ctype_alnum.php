<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * Returns TRUE if every character in text is either a letter or a digit, FALSE otherwise.
 * @see https://php.net/ctype-alnum
 * @param mixed $text
 */
function ctype_alnum($text): bool
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_alnum')) {
        return \ctype_alnum($text);
    }
    $cls = \Inilim\Tool\Method\PF\__resourceCache('convert_int_to_char_for_ctype');
    /** @var \Closure $cls */
    $text = $cls->__invoke($text, 'ctype_alnum');
    return \is_string($text) && '' !== $text && !\preg_match('/[^A-Za-z0-9]/', $text);
}
