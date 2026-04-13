<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * @build_skip
 */
function str_num_increment(string $string): string
{
    if ('' === $string) {
        throw new \Error(\Inilim\Tool\Num::class . '::str_num_increment(): Argument #1 ($string) cannot be empty');
    }
    if (!\preg_match('/^(\-?[1-9]{1}\d*|0)$/', $string)) {
        throw new \Error(\Inilim\Tool\Num::class . '::str_num_increment(): Argument #1 ($string) must be composed only of alphanumeric ASCII characters');
    }
    $len = \strlen($string);
    $negative = \strpos($string, '-') === 0;
    if ($negative) {
        $len--;
    }
    if (
        (\PHP_INT_SIZE === 4 && $len < 10)
        ||
        (\PHP_INT_SIZE === 8 && $len < 19)
    ) {
        return (string)++$string;
    }

    // var_dump(12323);
    $abs = $negative ? \substr($string, 1) : $string;

    $l_part = \substr($abs, 0, $len - 8);
    $r_part = \substr($abs, -8);
    /** 
     * @var string $l_part
     * @var string $r_part
     */
    if ($r_part !== '99999999' && $r_part !== '00000000') {
        $r_part = 1 . $r_part;
        $negative ? --$r_part : ++$r_part;
        $r_part = \substr((string)$r_part, 1);
        return ($negative ? '-' : '') . $l_part . $r_part;
    }

    $chars = \str_split($abs, 1);
    $i = $len - 1;

    if ($negative) {
        // Уменьшаем абсолютное значение на 1
        while ($i >= 0 && $chars[$i] === '0') {
            $chars[$i] = '9';
            $i--;
        }
        if ($i >= 0) {
            $chars[$i] = (string) ((int) $chars[$i] - 1);
        }
        $abs = \ltrim(\implode('', $chars), '0') ?: '0';
    } else {
        // Увеличиваем на 1
        while ($i >= 0 && $chars[$i] === '9') {
            $chars[$i] = '0';
            $i--;
        }
        if ($i >= 0) {
            $chars[$i] = (string) ((int) $chars[$i] + 1);
        } else {
            \array_unshift($chars, '1');
        }
        $abs = \implode('', $chars);
    }

    return $abs === '0' ? '0' : ($negative ? "-$abs" : $abs);
}
