<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\VD;

/**
 * @author inilim
 * @return void
 */
function tracee(int $limit = 0, bool $ignoreArgs = true)
{
    $options = \DEBUG_BACKTRACE_PROVIDE_OBJECT;
    if ($ignoreArgs) {
        $options |= \DEBUG_BACKTRACE_IGNORE_ARGS;
    }
    \Inilim\Tool\Method\VD\de(\debug_backtrace($options, $limit));
}
