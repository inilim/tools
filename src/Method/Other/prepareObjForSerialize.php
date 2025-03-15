<?php

namespace Inilim\Tool\Method\Other;

/**
 * @return mixed
 */
function prepareObjForSerialize(object $obj)
{
    $e = null;

    if ($obj instanceof \JsonSerializable) {
        $v = \Inilim\Tool\Method\Other\tryCallMethod($obj, 'jsonSerialize', [], null, $e);
        // jsonSerialize return mixed OR throw exception
        if ($e === null) {
            $v = [$v];
            \Inilim\Tool\Method\Other\prepareArrayForSerializeRecursive($v);
            return $v[0];
        }
    }
    $e = null;

    if ($obj instanceof \Serializable) {
        // __serialize return mixed OR throw exception
        $v = \Inilim\Tool\Method\Other\tryCallMethod($obj, '__serialize', [], null, $e);
        if ($e === null) {
            $v = [$v];
            \Inilim\Tool\Method\Other\prepareArrayForSerializeRecursive($v);
            return $v[0];
        }
    }
    $e = null;

    if (\PHP_VERSION_ID >= 80100 && $obj instanceof \UnitEnum) {
        return \get_class($obj) . '::' . $obj->name;
    }

    if (\method_exists($obj, 'toArray')) {
        $v = \Inilim\Tool\Method\Other\tryCallMethod($obj, 'toArray', [], null, $e);
        if ($e === null && \is_array($v)) {
            \Inilim\Tool\Method\Other\prepareArrayForSerializeRecursive($v);
            return $v;
        }
    }
    $e = null;

    if ($obj instanceof \Throwable) {
        $v = \Inilim\Tool\Method\Other\getExceptionDetails($obj, true);
        \Inilim\Tool\Method\Other\prepareArrayForSerializeRecursive($v);
        return $v;
    }

    $v = (array)$obj;
    \Inilim\Tool\Method\Other\prepareArrayForSerializeRecursive($v);
    return $v;
}
