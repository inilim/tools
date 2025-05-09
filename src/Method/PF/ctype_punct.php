<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * @param mixed $text
 */
function ctype_punct($text): bool
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_punct')) {
        return \ctype_punct($text);
    }
    $cls = \Inilim\Tool\Method\PF\__resourceCache('convert_int_to_char_for_ctype');
    /** @var \Closure $cls */
    $text = $cls->__invoke($text, 'ctype_punct');
    return \is_string($text) && '' !== $text && !\preg_match('/[^!-\/\:-@\[-`\{-~]/', $text);
}
