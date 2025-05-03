<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\VD;

/**
 * @author inilim
 * @param mixed ...$v
 * @return void
 */
function dde(...$v)
{
    if (($cur = \ob_get_level()) > 1) {
        while (true) {
            if (\ob_get_level() === 1) {
                break;
            }
            \ob_end_clean();
        }
        echo \sprintf('__CLIPBOARD__: "%s"', $cur) . PHP_EOL;
    }
    \Inilim\Tool\Method\VD\dd(...$v);
    exit();
}
