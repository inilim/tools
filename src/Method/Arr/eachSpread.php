<?php

namespace Inilim\Tool\Method\Arr;

/**
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
