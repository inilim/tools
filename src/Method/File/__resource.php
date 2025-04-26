<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * @return mixed
 */
function __resource(string $name)
{
    if (\is_file($name = __DIR__ . '/../../../files/resources/File/' . $name . '.php')) {
        return require $name;
    }

    return null;
}
