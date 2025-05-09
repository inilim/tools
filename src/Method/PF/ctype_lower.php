<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * @param mixed $text
 */
function ctype_lower($text): bool
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_lower')) {
        return \ctype_lower($text);
    }
    $cls = \Inilim\Tool\Method\PF\__resourceCache('convert_int_to_char_for_ctype');
    /** @var \Closure $cls */
    $text = $cls->__invoke($text, 'ctype_lower');
    return \is_string($text) && '' !== $text && !\preg_match('/[^a-z]/', $text);
}
