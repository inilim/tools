<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\VD;

/**
 * @author inilim
 * @param mixed ...$v
 * @return void
 */
function dd(...$v)
{
    \ob_start();
    \var_dump(...$v);
    $t = \preg_replace('#\=\>[\n\s]++\*RECURSION\*#', '=> *RECURSION*', \strval(\ob_get_clean()));

    if (\in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true)) {
        echo $t;
        echo PHP_EOL;
    } else {
        echo '<pre style="display: block;white-space: pre;padding: 5px;overflow: initial !important;">';
        echo $t;
        echo '</pre>';
    }
}
