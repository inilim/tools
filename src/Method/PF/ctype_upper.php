<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * @param mixed $text
 */
function ctype_upper($text): bool
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_upper')) {
        return \ctype_upper($text);
    }
    $cls = \Inilim\Tool\Method\Other\__resourceCache(__FUNCTION__, 'convert_int_to_char_for_ctype');
    /** @var \Closure $cls */
    $text = $cls->__invoke($text, 'ctype_upper');
    return \is_string($text) && '' !== $text && !\preg_match('/[^A-Z]/', $text);
}
