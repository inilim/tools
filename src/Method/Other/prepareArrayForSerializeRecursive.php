<?php

namespace Inilim\Tool\Method\Other;

\Inilim\Tool\Other::__include('prepareObjForSerialize');

function prepareArrayForSerializeRecursive(array &$value): void
{
    \array_walk_recursive($value, static function (&$subVal) {
        if (\is_object($subVal)) {
            $subVal = prepareObjForSerialize($subVal);
        } elseif (\is_resource($subVal)) {
            $subVal = \print_r($subVal, true);
        }
    });
}
