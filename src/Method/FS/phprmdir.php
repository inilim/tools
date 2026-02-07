<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

/**
 * @link https://php.net/manual/en/function.rmdir.php
 * @param null|resource $context
 */
function phprmdir(string $directory, $context = null): bool
{
    if ($context !== null) {
        \Inilim\Tool\Method\Assert\resource($context);
    }
    $value = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(
        static function () use ($directory, $context) {
            if ($context) {
                return \rmdir($directory, $context);
            }
            return \rmdir($directory);
        }
    );
    return $value === null ? false : $value;
}
