<?php

namespace Inilim\Tool\Method\ID;

/**
 * uniqid(more_entropy:true)
 * @see https://www.php.net/manual/ru/function.uniqid.php
 * @return string
 */
function uniqEntropy(string $prefix = '')
{
    return \uniqid($prefix, true);
}
