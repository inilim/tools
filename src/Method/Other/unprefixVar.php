<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @return string
 */
function unprefixVar(string $name)
{
    return \Inilim\Tool\Method\LarStr\trim(\strtr($name, [
        'static::$' => '',
        '$this->$'  => '',
        '$this->'   => '',
        'self::$'   => '',
        '$'         => '',
    ]));
}
