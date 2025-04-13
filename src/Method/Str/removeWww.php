<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @return string
 */
function removeWww(string $url)
{
    $res = \preg_replace('#^(www\.)#i', '', $url);
    if (!\is_string($res)) return $url;
    $res = \preg_replace('#(\:\/\/www\.)#i', '://', $res);
    if (!\is_string($res)) return $url;
    return $res;
}
