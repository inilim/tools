<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @param resource $res
 */
function get_resource_id($res): int
{
    if (\Inilim\Tool\Method\Check\php80()) {
        return \get_resource_id($res);
    }

    if (!\is_resource($res) && null === @\get_resource_type($res)) {
        throw new \TypeError(\sprintf(
            'Argument 1 passed to get_resource_id() must be of the type resource, %s given',
            \Inilim\Tool\Method\PF\get_debug_type($res)
        ));
    }

    return (int) $res;
}
