<?php

namespace Inilim\Tool\Method\Str;

/**
 * @return string
 */
function ent2ncr(string $text)
{
    //                 &brvbar;
    \preg_match_all('#\&[a-z\d]{2,7}\;|\|#i', $text, $ent);
    $ent = $ent[0] ?? [];
    if (!$ent) {
        return $text;
    }

    $ncr = [];
    foreach ($ent as $idx => $item) {
        $item = \Inilim\Tool\Method\Str\getNcrByEnt($item);
        if ($item === null) {
            unset($ent[$idx]);
            continue;
        }
        $ncr[] = $item;
    }

    if (!$ncr) {
        return $text;
    }

    return \str_replace($ent, $ncr, $text);
}
