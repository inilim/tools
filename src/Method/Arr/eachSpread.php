<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

/**
 * @deprecated use LarArr::***
 * @author Laravel
 * Execute a callback over each nested chunk of items.
 * @param callable(...mixed):mixed $callback
 * @return void
 */
function eachSpread(array $array, callable $callback)
{
    \Inilim\Tool\Method\Arr\each($array, static function ($chunk, $key) use ($callback) {
        $chunk[] = $key;
        return $callback(...$chunk);
    });
}
