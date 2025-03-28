<?php

namespace Inilim\Tool\Method\Other;

/**
 * @author Inilim
 * @return string
 */
function unprefixVar(string $name)
{
    return \Inilim\Tool\Method\Str\trim(\strtr($name, [
        '$'         => '',
        '$this->$'  => '',
        '$this->'   => '',
        'self::$'   => '',
        'static::$' => '',
    ]));
}
