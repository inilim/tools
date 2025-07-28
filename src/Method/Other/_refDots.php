<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * 
 * @template TValue og mixed
 * @template TArray of array<int|string,TValue>
 * @template TDots of array{"...":TValue[]}
 * 
 * @param TArray $array
 * @return array{...TArray, ...TDots}
 */
function _refDots(array $array): array
{
    $dots = [];
    foreach ($array as &$value) {
        $dots[] = &$value;
    }

    $array['...'] = $dots;
    return $array;
}
