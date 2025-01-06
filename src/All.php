<?php

namespace Inilim\Tool;

/**
 * @internal Inilim\Tool
 */
final class All
{
    const NAMESPACES = [
        \Inilim\Tool\Arr::class     => 'Inilim\Tool\Method\Arr\\',
        \Inilim\Tool\Integer::class => 'Inilim\Tool\Method\Integer\\',
        \Inilim\Tool\Double::class  => 'Inilim\Tool\Method\Double\\',
        \Inilim\Tool\Data::class    => 'Inilim\Tool\Method\Data\\',
        \Inilim\Tool\Str::class     => 'Inilim\Tool\Method\Str\\',
        \Inilim\Tool\Other::class   => 'Inilim\Tool\Method\Other\\',
        \Inilim\Tool\Json::class    => 'Inilim\Tool\Method\Json\\',
    ];

    static function __include($name)
    {
        // 
    }
}
