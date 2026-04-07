<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @todo tests
 */
function phpInfoCache(int $flags = \INFO_ALL, bool $fresh = false): ?string
{
    return \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use ($flags, $fresh) {
            $pathToFile = \sys_get_temp_dir() . '/inilim-tools-phpinfo-' . $flags . '.tmp';
            if ($fresh) {
                goto fresh;
            }
            if (\is_file($pathToFile)) {
                $result = \file_get_contents($pathToFile);
                if ($result === false) {
                    goto fresh;
                }
                /** @var string $result */
                return $result;
            } else {
                fresh:
                $info = \Inilim\Tool\Method\Other\phpInfo($flags);
                if ($info === null) {
                    return null;
                }
                \file_put_contents($pathToFile, $info);
                return $info;
            }
        },
        static function () {
            $message = \func_get_arg(1);
            /** @var string $message */
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $message, '', -1);
        }
    );
}
