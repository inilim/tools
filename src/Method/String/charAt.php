<?php

namespace Inilim\Tool\Method\String;

/**
 * Get the character at the specified index.
 * @return string|false
 */
function charAt(string $subject, int $index)
{
    $length = \mb_strlen($subject);

    if ($index < 0 ? $index < -$length : $index > $length - 1) {
        return false;
    }

    return \mb_substr($subject, $index, 1);
}
