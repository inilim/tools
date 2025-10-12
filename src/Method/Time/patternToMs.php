<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

/**
 * @todo 
 * @build_skip
 */
function patternToMs(string $pattern): int
{
    $y  = '|years|year|y|';
    $mo = '|months|month|mos|mo|';
    $w  = '|weaks|weak|w|';
    $d  = '|days|day|d|';
    $h  = '|hours|hour|h|';
    $m  = '|minutes|minute|mins|min|m|';
    $s  = '|seconds|second|secs|sec|s|';
    $ms = '|milliseconds|millisecond|msec|ms|';

    // $types = \Inilim\Tool\Method\Str\concat($ms, $s, $m, $d, $w, $mo, $y, $h);
    // $types = \explode('|', $types);
    // $types = \array_filter($types);
    // \usort($types, function ($a, $b) {
    //     return strlen($b) - strlen($a);
    // });
    // $types = \implode('|', $types);
    // de($types);

    $regex = '#([0-9]+)(milliseconds|millisecond|seconds|minutes|second|months|minute|hours|years|month|weaks|hour|secs|year|mins|days|msec|weak|mos|day|min|sec|mo|ms|w|d|m|s|y|h)#i';
    \preg_match_all($regex, $pattern, $matches, \PREG_SET_ORDER);

    foreach ($matches as [, $value, $type]) {

        $value = (int) $value;
        $type  = '|' . \strtolower($type) . '|';

        if (\Inilim\Tool\Method\PF\str_contains($y, $type)) {
            // Time::
        } elseif (\Inilim\Tool\Method\PF\str_contains($mo, $type)) {
        } elseif (\Inilim\Tool\Method\PF\str_contains($w, $type)) {
        } elseif (\Inilim\Tool\Method\PF\str_contains($d, $type)) {
        } elseif (\Inilim\Tool\Method\PF\str_contains($h, $type)) {
        } elseif (\Inilim\Tool\Method\PF\str_contains($m, $type)) {
        } elseif (\Inilim\Tool\Method\PF\str_contains($s, $type)) {
        } elseif (\Inilim\Tool\Method\PF\str_contains($ms, $type)) {
        }

        de($value, $type);
    }

    return 1;
}
