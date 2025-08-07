<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @skip_build
 * @return \Closure(array &$value):void
 */
function prepareArrayForSerializeRecursive(): \CLosure
{
    \Inilim\Tool\Method\Assert\__notArgsHere(__FUNCTION__, \func_num_args());
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
