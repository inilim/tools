<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * @param mixed $text
 * @return bool
 */
function ctype_upper($text)
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_upper')) {
        return \ctype_upper($text);
    }
    $cls = \Inilim\Tool\Method\PF\__resourceCache('ctype_upper');
    /** @var \Closure $cls */
    return $cls($text);
}
