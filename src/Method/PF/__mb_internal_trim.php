<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author symfony/polyfill
 */
function __mb_internal_trim(string $regex, string $string, ?string $characters, ?string $encoding, string $function): string
{
    if (null === $encoding) {
        $encoding = \mb_internal_encoding();
    }

    try {
        $validEncoding = @\mb_check_encoding('', $encoding);
    } catch (\ValueError $e) {
        throw new \ValueError(\sprintf('PF::%s(): Argument #3 ($encoding) must be a valid encoding, "%s" given', $function, $encoding));
    }

    // BC for PHP 7.3 and lower
    if (!$validEncoding) {
        throw new \ValueError(\sprintf('PF::%s(): Argument #3 ($encoding) must be a valid encoding, "%s" given', $function, $encoding));
    }

    if ('' === $characters) {
        return null === $encoding ? $string : \mb_convert_encoding($string, $encoding);
    }

    if ('UTF-8' === $encoding || \in_array(\strtolower($encoding), ['utf-8', 'utf8'], true)) {
        $encoding = 'UTF-8';
    }

    $string = \mb_convert_encoding($string, 'UTF-8', $encoding);

    if (null !== $characters) {
        $characters = \mb_convert_encoding($characters, 'UTF-8', $encoding);
    }

    if (null === $characters) {
        $characters = "\\0 \f\n\r\t\v\u{00A0}\u{1680}\u{2000}\u{2001}\u{2002}\u{2003}\u{2004}\u{2005}\u{2006}\u{2007}\u{2008}\u{2009}\u{200A}\u{2028}\u{2029}\u{202F}\u{205F}\u{3000}\u{0085}\u{180E}";
    } else {
        $characters = \preg_quote($characters);
    }

    $string = \preg_replace(\sprintf($regex, $characters), '', $string);

    if ('UTF-8' === $encoding) {
        return $string;
    }

    return \mb_convert_encoding($string, $encoding, 'UTF-8');
}
