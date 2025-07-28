<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @todo to check
 * @author Inilim
 * @param class-string|object ...$classes
 */
function instanceOfAll(object $obj, ...$classes): bool
{
    return \Inilim\Tool\Method\Other\instanceOfAllArray($obj, $classes);
}
