<?php

/**
 * Converts integers to their char versions according to normal ctype behaviour, if needed.
 *
 * If an integer between -128 and 255 inclusive is provided,
 * it is interpreted as the ASCII value of a single character
 * (negative values have 256 added in order to allow characters in the Extended ASCII range).
 * Any other integer is interpreted as a string containing the decimal digits of the integer.
 *
 * @param mixed $int
 * @param string $function
 * @return mixed
 */
return static function ($int, $function) {
    if (!\is_int($int)) {
        return $int;
    }

    if ($int < -128 || $int > 255) {
        return (string) $int;
    }

    if (\PHP_VERSION_ID >= 80100) {
        @\trigger_error($function . '(): Argument of type int will be interpreted as string in the future', \E_USER_DEPRECATED);
    }

    if ($int < 0) {
        $int += 256;
    }

    return \chr($int);
};
