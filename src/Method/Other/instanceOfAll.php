<?php

namespace Inilim\Tool\Method\Other;

/**
 * @param class-string|object ...$classes
 * @return bool
 */
function instanceOfAll(object $obj, ...$classes)
{
    return \Inilim\Tool\Method\Other\instanceOfAllArray($obj, $classes);
}
