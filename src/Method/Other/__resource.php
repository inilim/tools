<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @return mixed
 */
function __resource(string $namespace, string $name)
{
    // __FUNCTION__ => Inilim\Tool\Method\Other\__resource => Other
    $class = \basename(\dirname(\strtr($namespace, '\\', '/')));
    $name = \sprintf('%s/../../../files/resources/%s/%s.php', __DIR__, $class, $name);
    if (\is_file($name)) {
        return require $name;
    }

    return null;
}
