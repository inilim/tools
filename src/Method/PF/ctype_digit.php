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
    $cls = \Inilim\Tool\Method\PF\__resourceCache('convert_int_to_char_for_ctype');
    /** @var \Closure $cls */
    $text = $cls->__invoke($text, 'ctype_digit');
    return \is_string($text) && '' !== $text && !\preg_match('/[^0-9]/', $text);
}
