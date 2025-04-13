<?php

namespace Inilim\Tool\Method\Str;

/**
 * Convert the case of a string.
 * @return string
 */
function convertCase(string $string, int $mode = \MB_CASE_FOLD, ?string $encoding = 'UTF-8')
{
    if (\PHP_VERSION_ID >= 80000) {
        return \mb_convert_case($string, $mode, $encoding);
    }

    if ('' === $string) {
        return '';
    }
    $s = $string;

    static $state = null;
    if ($state === null) {
        $state = \Inilim\Tool\Method\Str\__state();
    }

    $encoding = $state->getEncoding($encoding);

    if ('UTF-8' === $encoding) {
        $encoding = null;
        if (!\preg_match('//u', $s)) {
            $s = @\iconv('UTF-8', 'UTF-8//IGNORE', $s);
        }
    } else {
        $s = \iconv($encoding, 'UTF-8//IGNORE', $s);
    }

    if (\MB_CASE_TITLE == $mode) {
        static $titleRegexp = null;
        if (null === $titleRegexp) {
            $titleRegexp = \Inilim\Tool\Method\Data\__resource('titleCaseRegexp');
        }
        $s = \preg_replace_callback($titleRegexp, [__CLASS__, 'title_case'], $s);
    } else {
        if (\MB_CASE_UPPER == $mode) {
            static $upper = null;
            if (null === $upper) {
                $upper = \Inilim\Tool\Method\Data\__resource('upperCase');
            }
            $map = $upper;
        } else {
            // MB_CASE_FOLD
            if (\PHP_INT_MAX === $mode) {
                static $caseFolding = null;
                if (null === $caseFolding) {
                    $caseFolding = \Inilim\Tool\Method\Data\__resource('caseFolding');
                }
                $s = \strtr($s, $caseFolding);
            }

            static $lower = null;
            if (null === $lower) {
                $lower = \Inilim\Tool\Method\Data\__resource('lowerCase');
            }
            $map = $lower;
        }

        static $ulenMask = ["\xC0" => 2, "\xD0" => 2, "\xE0" => 3, "\xF0" => 4];

        $i = 0;
        $len = \strlen($s);

        while ($i < $len) {
            $ulen = $s[$i] < "\x80" ? 1 : $ulenMask[$s[$i] & "\xF0"];
            $uchr = \substr($s, $i, $ulen);
            $i += $ulen;

            if (isset($map[$uchr])) {
                $uchr = $map[$uchr];
                $nlen = \strlen($uchr);

                if ($nlen == $ulen) {
                    $nlen = $i;
                    do {
                        $s[--$nlen] = $uchr[--$ulen];
                    } while ($ulen);
                } else {
                    $s = \substr_replace($s, $uchr, $i - $ulen, $ulen);
                    $len += $nlen - $ulen;
                    $i += $nlen - $ulen;
                }
            }
        }
    }

    if (null === $encoding) {
        return $s;
    }

    return \iconv('UTF-8', $encoding . '//IGNORE', $s);
}
