<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check;

/**
 * @author inilim
 * @psalm-pure
 * @psalm-assert-if-true string $value
 * @phpstan-assert-if-true string $value
 * 
 * 
 * @param mixed $value
 */
function uuidv7($value): bool
{
    // source https://regex101.com/library/dnT07Y?orderBy=MOST_RECENT&search=html&page=1
    return \is_string($value) && (bool)\preg_match('/^[0-9a-f]{8}(?:\-[0-9a-f]{4}){3}-[0-9a-f]{12}$/', $value);
}
