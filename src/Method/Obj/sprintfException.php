<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

/**
 * @author inilim
 * @template T of \Throwable
 *
 * @param array $values
 * @param class-string<T>|T $classOrObj
 * @return T
 */
function sprintfException(
    string $format = '',
    array $values  = [],
    $classOrObj    = \Exception::class,
    array $args    = []
): \Throwable {
    $message = \sprintf($format, ...$values);
    if (\is_object($classOrObj)) {
        $class = \get_class($classOrObj);
        return \Inilim\Tool\Method\Obj\rewriteLocationException(
            new $class($message, ...$args),
            $classOrObj->getFile(),
            $classOrObj->getLine()
        );
    } else {
        return new $classOrObj($message, ...$args);
    }
}
