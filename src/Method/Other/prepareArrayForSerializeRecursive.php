<?php

namespace Inilim\Tool\Method\Other;

/**
 * @return void
 */
function prepareArrayForSerializeRecursive(array &$value)
{
    \array_walk_recursive($value, static function (&$subVal) {
        if (\is_object($subVal)) {
            $subVal = \Inilim\Tool\Method\Other\prepareObjForSerialize($subVal);
        } elseif (\is_resource($subVal)) {
            $subVal = \print_r($subVal, true);
        }
    });
}
