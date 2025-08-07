<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @param string[]|array<string,string>|array<string,string[]> $headers
 * @param string[] $expectName
 * @return array<string,string[]>
 */
function normalizeHeaders(array $headers, array $expectName = []): array
{
    if (!$headers) {
        return [];
    }

    d($headers);

    $hasExpectedName = !!$expectName;
    if ($hasExpectedName) {
        \Inilim\Tool\Method\Assert\allString($expectName);
        $expectName = \array_map(static fn($name) => \strtolower($name) . ':', $expectName);
    }

    $dots = \Inilim\Tool\Method\Arr\dot($headers, '', '|');

    d($dots);

    if (\Inilim\Tool\Method\Exp\stringContainsInArray($dots, ':')) {
        foreach ($dots as $dotKeys => $item) {
            if (\is_string($dotKeys) && \Inilim\Tool\Method\PF\str_contains($item, ':')) {
                $value = \explode(':', $item, 2)[1];
                $dots[] = $item;
                $dots[$dotKeys] = $value;
            }
        }
    }

    d($dots);

    $lines = [];
    foreach (
        $dots as $dotKeys => &$value
    ) {
        if (\is_int($dotKeys)) {
            $header = \strtr($value, [': ' => ':']);
        } elseif (\Inilim\Tool\Method\PF\str_contains($dotKeys, '|')) {
            \Inilim\Tool\Method\Assert\httpHeaderValue($value);
            $names = \preg_replace([
                '#^(\d+\|)#',
                '#(\|\d+)$#',
            ], '', $dotKeys);
            $names = \preg_split('#\|#', $names, -1, \PREG_SPLIT_NO_EMPTY);
            foreach ($names as $name) {
                \Inilim\Tool\Method\Assert\httpHeaderName($name);
                $dots[] = $name . ':' . $value;
            }
            continue;
        } elseif (\Inilim\Tool\Method\PF\str_contains($value, ':')) {
            \Inilim\Tool\Method\Assert\httpHeaderValue($value);
            [$name, $value] = \explode(':', $value, 2);
            \Inilim\Tool\Method\Assert\httpHeaderName($dotKeys);
            \Inilim\Tool\Method\Assert\httpHeaderName($name);
            $header = $dotKeys . ':' . $value;
            $header = $name . ':' . $value;
        } else {
            \Inilim\Tool\Method\Assert\httpHeaderValue($value);
            \Inilim\Tool\Method\Assert\httpHeaderName($dotKeys);
            $header = $dotKeys . ':' . $value;
        }

        unset($dots[$dotKeys]);

        if ($hasExpectedName && \Inilim\Tool\Method\Str\startsWith($header, $expectName, true)) {
            continue;
        }

        $lines[] = $header;
    }

    de($lines);

    if (!$lines) {
        return [];
    }

    return \Inilim\Tool\Method\Exp\headersFromLines($lines);
}
