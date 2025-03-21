<?php

namespace Inilim\Tool\Method\Other;

/**
 * @skip_build
 * @return \Closure(array &$value):void
 */
function prepareArrayForSerializeRecursive()
{
    return static function (array &$value) {
        \array_walk_recursive($value, static function (&$subVal) {
            if (\is_object($subVal)) {
                $subVal = \Inilim\Tool\Method\Other\prepareObjForSerialize($subVal);
            } elseif (\is_resource($subVal)) {
                $subVal = \print_r($subVal, true);
            }
        });
    };
}
