<?php

namespace Inilim\Method\Other;

use Inilim\Tool\Other;

Other::__include('prepareObjForSerialize');

function prepareArrayForSerializeRecursive(array &$value): void
{
    \array_walk_recursive($value, static function (&$subVal) {
        if (\is_object($subVal)) {
            $subVal = Other::prepareObjForSerialize($subVal);
        } elseif (\is_resource($subVal)) {
            $subVal = \print_r($subVal, true);
        }
    });
}
