<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 */
function isList(array $array): bool
{
    return \Inilim\Tool\Method\PF\array_is_list($array);
}
