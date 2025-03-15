<?php

namespace Inilim\Tool\Method\Other;

/**
 * @param class-string|object ...$classes
 * @return bool
 */
function instanceOfAny(object $obj, ...$classes)
{
    return \Inilim\Tool\Method\Other\instanceOfAnyArray($obj, $classes);
}
