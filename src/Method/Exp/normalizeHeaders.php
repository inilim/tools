<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * @todo tests
 * @psalm-import-type Param_1_normalizeHeaders from \TypeExp
 * @psalm-import-type Return_normalizeHeaders from \TypeExp
 * 
 * @param Param_1_normalizeHeaders $headers
 * @return Return_normalizeHeaders
 */
function normalizeHeaders(array $headers): array
{
    if (!$headers) {
        return [];
    }

    $lines = [];
    $nameCompleted = [];
    foreach ($headers as $name => &$values) {

        if (isset($nameCompleted[$name])) {
            continue;
        }

        if (\is_string($values)) {
            if (\is_string($name)) {
                $values = [$values];
            } else {
                $lines[] = $values;
                unset($headers[$name]);
                continue;
            }
        }

        \Inilim\Tool\Method\Assert\httpHeaderName($name);
        /** @var string $name */

        foreach ($values as $value) {
            \Inilim\Tool\Method\Assert\httpHeaderValue($value);
        }

        $newName = \strtolower($name);
        if ($newName !== $name) {
            $headers[$newName] = $values;
            unset($headers[$name]);
        }

        $nameCompleted[$name] = true;
    }

    if ($lines) {
        foreach (\Inilim\Tool\Method\Exp\headersFromLines($lines) as $name => $values) {
            $name = \strtolower($name);
            if (isset($headers[$name])) {
                $headers[$name] = \array_merge($headers[$name], $values);
            } else {
                $headers[$name] = $values;
            }
        }
    }

    return $headers;
}
