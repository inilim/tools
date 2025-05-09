<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * @param mixed $text
 */
function ctype_space($text): bool
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_space')) {
        return \ctype_space($text);
    }
    $cls = \Inilim\Tool\Method\PF\__resourceCache('convert_int_to_char_for_ctype');
    /** @var \Closure $cls */
    $text = $cls->__invoke($text, 'ctype_space');
    return \is_string($text) && '' !== $text && !\preg_match('/[^\s]/', $text);
}
