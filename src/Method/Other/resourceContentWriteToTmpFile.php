<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @todo tests
 * @param resource $resource
 */
function resourceContentWriteToTmpFile($resource): ?string
{
    return \Inilim\Tool\Method\Other\resourceContentWriteToFile(
        $resource,
        \Inilim\Tool\Method\Path\normalize(\sys_get_temp_dir() . '/inilim-tools-' . \Inilim\Tool\Method\ID\uuidv4() . '.tmp')
    );
}
