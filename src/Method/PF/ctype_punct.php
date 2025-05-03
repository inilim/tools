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
    $cls = \Inilim\Tool\Method\PF\__resourceCache('ctype_punct');
    /** @var \Closure $cls */
    return $cls($text);
}
