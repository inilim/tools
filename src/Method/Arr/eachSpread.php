<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('each');

/**
 * Execute a callback over each nested chunk of items.
 * @param callable(...mixed): mixed $callback
 */
function eachSpread(array $array, callable $callback): void
{
    \Inilim\Method\Arr\each($array, static function ($chunk, $key) use ($callback) {
        $chunk[] = $key;
        return $callback(...$chunk);
    });
}
