<?php

namespace Inilim\Tool\Method\Str;

/**
 * segment url path | 
 * "/sites/16/page/36/settings" | 0 - "sites" | 1 - "16" | 2 - "page" | 3 - "36" | 4 - "settings" | 5 - NULL
 */
function getSegmentPath(string $path, int $segment): ?string
{
    return \Inilim\Tool\Method\Str\getSegmentsPath($path)[$segment] ?? null;
}
