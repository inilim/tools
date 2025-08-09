<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author guzzle/guzzle
 * @author inilim
 * Parses an array of header lines into an associative array of headers.
 *
 * @param iterable<string> $lines Header lines array of strings in the following
 *                        format: "Name: Value"
 * 
 * @return array<string,string[]>
 */
function headersFromLines(iterable $lines): array
{
    $headers = [];
    foreach ($lines as $line) {
        if ($line === '') {
            continue;
        }
        \Inilim\Tool\Method\Assert\contains($line, ':');
        [$name, $values] = \explode(':', $line, 2);
        $name = \trim($name);
        \Inilim\Tool\Method\Assert\httpHeaderName($name);
        if (\Inilim\Tool\Method\PF\str_contains($values, ',')) {
            $values = \explode(',', $values);
            /** @var string[] $values */
        } else {
            $values = [$values];
        }

        $headers[$name] ??= [];
        foreach ($values as $value) {
            \Inilim\Tool\Method\Assert\httpHeaderValue($value);
            $headers[$name][] = \trim($value);
        }
    }

    return $headers;
}
