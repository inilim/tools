<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @todo tests
 */
function phpInfo(int $flags = \INFO_ALL): ?string
{
    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use ($flags) {
            $curLvl = \ob_get_level();
            \ob_start();
            if ($curLvl === \ob_get_level()) {
                return null;
            }
            \phpinfo($flags);
            return \ob_get_clean();
        },
        static function () {
            $message = (string)\func_get_arg(1);
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $message, '', -1);
        }
    );

    return \is_string($result) ? $result : null;
}
