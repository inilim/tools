<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\ID;

/**
 * uniqid(more_entropy:true)
 * @see https://www.php.net/manual/ru/function.uniqid.php
 */
function uniqEntropy(string $prefix = ''): string
{
    return \uniqid($prefix, true);
}
