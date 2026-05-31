<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 * @ext mbstring
 */
function mb_lcfirst(string $string, ?string $encoding = null): string
{
    if (\Inilim\Tool\Method\Check\php84()) {
        return \mb_lcfirst($string, $encoding);
    }

    if (null === $encoding) {
        $encoding = \mb_internal_encoding();
    }

    try {
        $validEncoding = @\mb_check_encoding('', $encoding);
    } catch (\Error $e) {
        throw new \Error(\sprintf('PF::mb_lcfirst(): Argument #2 ($encoding) must be a valid encoding, "%s" given', $encoding));
    }

    // BC for PHP 7.3 and lower
    if (!$validEncoding) {
        throw new \Error(\sprintf('PF::mb_lcfirst(): Argument #2 ($encoding) must be a valid encoding, "%s" given', $encoding));
    }

    $firstChar = \mb_substr($string, 0, 1, $encoding);
    $firstChar = \mb_convert_case($firstChar, \MB_CASE_LOWER, $encoding);

    return $firstChar . \mb_substr($string, 1, null, $encoding);
}
