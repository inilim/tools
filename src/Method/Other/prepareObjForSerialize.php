<?php

namespace Inilim\Tool\Method\Other;

\Inilim\Tool\Other::__include([
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
        $v = tryCallMethod($obj, 'jsonSerialize', [], null, $e);
        // jsonSerialize return mixed OR throw exception
        if ($e === null) {
            $v = [$v];
            prepareArrayForSerializeRecursive($v);
            return $v[0];
        }
    }
    $e = null;

    if ($obj instanceof \Serializable) {
        // __serialize return mixed OR throw exception
        $v = tryCallMethod($obj, '__serialize', [], null, $e);
        if ($e === null) {
            $v = [$v];
            prepareArrayForSerializeRecursive($v);
            return $v[0];
        }
    }
    $e = null;

    if (\PHP_VERSION_ID >= 80100 && $obj instanceof \UnitEnum) {
        return \get_class($obj) . '::' . $obj->name;
    }

    if (\method_exists($obj, 'toArray')) {
        $v = tryCallMethod($obj, 'toArray', [], null, $e);
        if ($e === null && \is_array($v)) {
            prepareArrayForSerializeRecursive($v);
            return $v;
        }
    }
    $e = null;

    if ($obj instanceof \Throwable) {
        $v = getExceptionDetails($obj, true);
        prepareArrayForSerializeRecursive($v);
        return $v;
    }

    $v = (array)$obj;
    prepareArrayForSerializeRecursive($v);
    return $v;
}
