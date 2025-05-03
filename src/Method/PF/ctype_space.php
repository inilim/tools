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
    $cls = \Inilim\Tool\Method\PF\__resourceCache('ctype_space');
    /** @var \Closure $cls */
    return $cls($text);
}
