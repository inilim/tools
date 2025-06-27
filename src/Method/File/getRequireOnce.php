<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File;

/**
 * Get the returned value of a file.
 *
 * @param mixed[] $data
 * @return mixed
 * @throws \Exception
 */
function getRequireOnce(string $pathToFile, array $data = [])
{
    return \Inilim\Tool\Method\File\getRequire($pathToFile, $data, true);
}
