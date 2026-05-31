<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @ext mbstring
 * @param (int|string)[] $parts
 */
function insertBetweenSubstrAfterMerge(
    string $string,
    array $parts,
    string $separator = '/',
    string $encoding  = 'UTF-8'
): string {
    \Inilim\Tool\Method\Assert\extPhp('mbstring');
    $result      = '';
    $posPositive = 0;
    $posNegative = 0;
    $strLen = -\mb_strlen($string, $encoding);
    foreach ($parts as $lenOrStr) {
        if (\is_string($lenOrStr)) {
            $result .= $separator . $lenOrStr;
            continue;
        }
        if ($lenOrStr === 0) {
            continue;
        }

        if ($lenOrStr > 0) {
            $substr = \mb_substr($string, $posPositive, $lenOrStr, $encoding);
            $posPositive += $lenOrStr;
        } else {
            $posNegative += $lenOrStr;
            // dd([
            //     '$posNegative' => $posNegative,
            //     '$strLen' => $strLen,
            //     '>' => $posNegative > $strLen,
            //     '>=' => $posNegative >= $strLen,
            //     '<' => $posNegative < $strLen,
            //     '<=' => $posNegative <= $strLen,
            // ]);
            if ($posNegative >= $strLen) {
                $substr = \mb_substr($string, $posNegative, \abs($lenOrStr), $encoding);
            } else {
                $substr = '';
            }
        }
        if ($substr === '') {
            continue;
        }
        $result .= $separator . $substr;
    }

    $len = \strlen($separator);
    return \substr($result, $len, \strlen($result) - $len);
}
