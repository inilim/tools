<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @return string
 */
function ncr2ent(string $text)
{
    //                &#34;
    \preg_match_all('#\&\#\d{2,4}\;#', $text, $ncr);
    $ncr = $ncr[0] ?? [];
    if (!$ncr) {
        return $text;
    }

    $ent = [];
    foreach ($ncr as $idx => $item) {
        $item = \Inilim\Tool\Method\Str\getEntByNcr($item);
        if ($item === null) {
            unset($ncr[$idx]);
            continue;
        }
        $ent[] = $item;
    }

    if (!$ent) {
        return $text;
    }

    return \str_replace($ncr, $ent, $text);
}
