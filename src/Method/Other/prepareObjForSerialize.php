<?php

namespace Inilim\Method\Other;

use Inilim\Tool\Other;

Other::__include([
    'tryCallMethod',
    'prepareArrayForSerializeRecursive',
    'getExceptionDetails',
]);

/**
 * @return mixed
 */
function prepareObjForSerialize(object $obj)
{
    $e = null;

    if ($obj instanceof \JsonSerializable) {
        $v = Other::tryCallMethod($obj, 'jsonSerialize', exception: $e);
        // jsonSerialize return mixed OR throw exception
        if ($e === null) {
            $v = [$v];
            Other::prepareArrayForSerializeRecursive($v);
            return $v[0];
        }
    }
    $e = null;

    if ($obj instanceof \Serializable) {
        // __serialize return mixed OR throw exception
        $v = Other::tryCallMethod($obj, '__serialize', exception: $e);
        if ($e === null) {
            $v = [$v];
            Other::prepareArrayForSerializeRecursive($v);
            return $v[0];
        }
    }
    $e = null;

    if (\PHP_VERSION_ID >= 80100 && $obj instanceof \UnitEnum) {
        return $obj::class . '::' . $obj->name;
    }

    if (\method_exists($obj, 'toArray')) {
        $v = Other::tryCallMethod($obj, 'toArray', exception: $e);
        if ($e === null && \is_array($v)) {
            Other::prepareArrayForSerializeRecursive($v);
            return $v;
        }
    }
    $e = null;

    if ($obj instanceof \Throwable) {
        $v = Other::getExceptionDetails($obj, true);
        Other::prepareArrayForSerializeRecursive($v);
        return $v;
    }

    $v = (array)$obj;
    Other::prepareArrayForSerializeRecursive($v);
    return $v;
}
