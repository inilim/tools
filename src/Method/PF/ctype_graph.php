<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * @param mixed $text
 * @return bool
 */
function ctype_graph($text)
{
    if (\Inilim\Tool\Method\Other\funcPhp('ctype_graph')) {
        return \ctype_graph($text);
    }
    $cls = \Inilim\Tool\Method\PF\__resourceCache('ctype_graph');
    /** @var \Closure $cls */
    return $cls($text);
}
