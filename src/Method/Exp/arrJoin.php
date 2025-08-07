<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * as implode();
 *
 * @param mixed[] $array
 * @param array<string,string|\Closure(mixed,string):string> $typeAs
 */
function arrJoin(array $array, string $separator = '', array $typeAs = []): string
{
    $hasTypeAs = !!$typeAs;
    $results = [];
    foreach ($array as $value) {
        if ($hasTypeAs) {
            $type    = \Inilim\Tool\Method\Other\getType($value, true);
            $replace = $typeAs[$type] ?? null;
            if ($replace !== null) {
                if ($replace instanceof \Closure) {
                    $value = $replace($value, $type);
                } else {
                    $value = $replace;
                }
            }
        }
        $results[] = \strval($value);
    }

    return \implode($separator, $results);
}
