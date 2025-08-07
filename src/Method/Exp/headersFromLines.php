<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author guzzle/guzzle
 * Parses an array of header lines into an associative array of headers.
 *
 * @param iterable<string> $lines Header lines array of strings in the following
 *                        format: "Name: Value"
 * 
 * @return array<string,array<string|null>>
 */
function headersFromLines(iterable $lines): array
{
    $headers = [];
    foreach ($lines as $line) {
        [$name, $value] = \explode(':', $line, 2);
        $name = \trim($name);

        $headers[$name] ??= [];
        $headers[$name][] = isset($value) ? \trim($value) : null;
    }

    return $headers;
}
