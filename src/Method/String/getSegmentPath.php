<?php

namespace Inilim\Tool\Method\String;

\Inilim\Tool\Str::__include('getSegmentsPath');

/**
 * segment url path | 
 * "/sites/16/page/36/settings" | 0 - "sites" | 1 - "16" | 2 - "page" | 3 - "36" | 4 - "settings" | 5 - NULL
 */
function getSegmentPath(string $path, int $segment): ?string
{
    return getSegmentsPath($path)[$segment] ?? null;
}

    // function getSegmentPath(string $path, int $segment): string
    // {
    //     $t = \_str()->getSegmentsPath($path);
    //     return $t[$segment] ?? '';
    // }
