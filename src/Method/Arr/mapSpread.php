<?php

namespace Inilim\Method\Arr;

use Inilim\Tool\Arr;

Arr::__include('map');

/**
 * Run a map over each nested chunk of items.
 */
function mapSpread(array $array, callable $callback): array
{
    return \Inilim\Method\Arr\map($array, static function ($chunk) use ($callback) {
        return $callback(...$chunk);
    });
}
