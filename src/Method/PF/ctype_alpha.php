<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * Returns TRUE if every character in text is a letter, FALSE otherwise.
 * @see https://php.net/ctype-alpha
 * @param mixed $text
 */
function ctype_alpha($text): bool
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_alpha')) {
        return \ctype_alpha($text);
    }
    $cls = \Inilim\Tool\Method\Other\__resourceCache(__FUNCTION__, 'convert_int_to_char_for_ctype');
    /** @var \Closure $cls */
    $text = $cls->__invoke($text, 'ctype_alpha');
    return \is_string($text) && '' !== $text && !\preg_match('/[^A-Za-z]/', $text);
}
