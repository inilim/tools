<?php

namespace Inilim\Tool;

final class Other extends \Inilim\Tool\LazyMethodAbstract
{
    protected const NAMESPACE = 'Inilim\Tool\Method\Other',
        PATH_TO_DIR           = __DIR__ . '/MethodMin/Other',
        ALIAS                 = [],
        IDX                   = 7;

    /**
     * @skip_build
     * @return void
     */
    static function prepareArrayForSerializeRecursive(array &$value)
    {
        \array_walk_recursive($value, static function (&$subVal) {
            if (\is_object($subVal)) {
                $subVal = self::prepareObjForSerialize($subVal);
            } elseif (\is_resource($subVal)) {
                $subVal = \print_r($subVal, true);
            }
        });
    }

    /**
     * @skip_build
     * TODO вместо tryCall сделать изолированный с обработчиком ошибок
     * @return mixed
     */
    static function prepareObjForSerialize(object $obj)
    {
        if ($obj instanceof \JsonSerializable) {
            $v = self::tryCallMethod($obj, 'jsonSerialize', [], null);
            // jsonSerialize return mixed OR throw exception
            if ($v['exception'] === null) {
                $v = [$v['result']];
                self::prepareArrayForSerializeRecursive($v);
                return $v[0];
            }
        }

        if ($obj instanceof \Serializable) {
            // __serialize return mixed OR throw exception
            $v = self::tryCallMethod($obj, '__serialize', [], null);
            if ($v['exception'] === null) {
                $v = [$v['result']];
                self::prepareArrayForSerializeRecursive($v);
                return $v[0];
            }
        }

        if (\PHP_VERSION_ID >= 80100 && $obj instanceof \UnitEnum) {
            return \get_class($obj) . '::' . $obj->name;
        }

        if (\method_exists($obj, 'toArray')) {
            $v = self::tryCallMethod($obj, 'toArray', [], null);
            if ($v['exception'] === null && \is_array($v['result'])) {
                self::prepareArrayForSerializeRecursive($v['result']);
                return $v['result'];
            }
        }

        if ($obj instanceof \Throwable) {
            $v = self::getExceptionDetails($obj, true);
            self::prepareArrayForSerializeRecursive($v);
            return $v;
        }

        $v = (array)$obj;
        self::prepareArrayForSerializeRecursive($v);
        return $v;
    }

    /**
     * @template T of bool
     * @psalm-type Trace = (T is true ? array : string)
     * @psalm-return array{message:string,line:int,code:int,file:string,trace:Trace,class:class-string}
     * @param T $traceAsArray
     */
    static function getExceptionDetails(\Throwable $e, bool $traceAsArray = false)
    {
        return [
            'message' => $e->getMessage(),
            'line'    => $e->getLine(),
            'code'    => $e->getCode(),
            'file'    => $e->getFile(),
            'trace'   => $traceAsArray ? $e->getTrace() : $e->getTraceAsString(),
            'class'   => \get_class($e),
        ];
    }

    /**
     * @template T of mixed
     * @param T $default
     * @param object|class-string $objectOrClass
     * @return array{result:mixed|T,exception:null|\Throwable}
     */
    function tryCallMethod($objectOrClass, string $methodName, array $args = [], $default = null)
    {
        return self::tryCallCallable([$objectOrClass, $methodName], $args, $default);
    }

    /**
     * @template C of mixed
     * @template D of mixed
     * @template A of mixed
     * 
     * @param callable(...A):C $callable
     * @param array<A> $args
     * @param D $default
     * @return array{result:C|D,exception:null|\Throwable}
     */
    function tryCallCallable(callable $callable, array $args = [], $default = null)
    {
        try {
            $result = \call_user_func_array($callable, $args);
        } catch (\Throwable $e) {
            return [
                'result'    => $default,
                'exception' => $e,
            ];
        }
        return [
            'result'    => $result,
            'exception' => null,
        ];
    }
}
