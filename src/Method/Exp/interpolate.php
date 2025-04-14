<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author princejohnsantillan <https://github.com/princejohnsantillan>
 * Interpolate placeholders in a string with mapped values.
 * @param  array<string,string>  $map
 * @return string
 */
function interpolate(string $string, array $map, bool $preserveMissing = true, string $pattern = '/{{\s*(\w+)\s*}}/')
{
    $interpolated = \preg_replace_callback(
        $pattern,
        static function (array $matches) use ($map, $preserveMissing) {
            [$value, $key] = $matches;

            return \array_key_exists($key, $map)
                ? $map[$key]
                : ($preserveMissing ? $value : '');
        },
        $string
    );

    return $interpolated ?? '';
}
