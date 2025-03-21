<?php

namespace Inilim\Tool\Method\Other;

/**
 * @skip_build
 * TODO вместо tryCall сделать изолированный с обработчиком ошибок
 * @return mixed
 */
function prepareObjForSerialize(object $obj)
{
    $prepareArrayForSerializeRecursive = \Inilim\Tool\Method\Other\prepareArrayForSerializeRecursive();
    if ($obj instanceof \JsonSerializable) {
        $v = \Inilim\Tool\Method\Other\tryCallMethod($obj, 'jsonSerialize', [], null);
        // jsonSerialize return mixed OR throw exception
        if ($v['exception'] === null) {
            $v = [$v['result']];
            $prepareArrayForSerializeRecursive($v);
            return $v[0];
        }
    }

    if ($obj instanceof \Serializable) {
        // __serialize return mixed OR throw exception
        $v = \Inilim\Tool\Method\Other\tryCallMethod($obj, '__serialize', [], null);
        if ($v['exception'] === null) {
            $v = [$v['result']];
            $prepareArrayForSerializeRecursive($v);
            return $v[0];
        }
    }

    if (\PHP_VERSION_ID >= 80100 && $obj instanceof \UnitEnum) {
        return \get_class($obj) . '::' . $obj->name;
    }

    if (\method_exists($obj, 'toArray')) {
        $v = \Inilim\Tool\Method\Other\tryCallMethod($obj, 'toArray', [], null);
        if ($v['exception'] === null && \is_array($v['result'])) {
            $prepareArrayForSerializeRecursive($v['result']);
            return $v['result'];
        }
    }

    if ($obj instanceof \Throwable) {
        $v = \Inilim\Tool\Method\Other\getExceptionDetails($obj, true);
        $prepareArrayForSerializeRecursive($v);
        return $v;
    }

    $v = (array)$obj;
    $prepareArrayForSerializeRecursive($v);
    return $v;
}
