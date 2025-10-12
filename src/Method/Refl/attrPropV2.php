<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Refl;

/**
 * @skip_build
 * @author Inilim
 * @template T of object
 * @param class-string<T>|T $classOrObj
 * @return \ReflectionAttribute[]|null
 */
function attrPropV2($classOrObj, string $prop, bool $throw = false)
{
    \Inilim\Tool\Method\Assert\php80();

    $refl = \Inilim\Tool\Method\Refl\_class($classOrObj, $throw);

    try {
        $reflProp = $refl->getProperty($prop);
    } catch (\ReflectionException $e) {
        if ($throw) {
            throw $e;
        }
        return null;
    }

    // \Inilim\Tool\Method\Arr\mapFilter();

    return $reflProp->getAttributes();
}
