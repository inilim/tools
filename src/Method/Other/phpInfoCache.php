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
            $pathToFile = \sprintf(
                '%s/inilim-tools-phpinfo-%s-flags_%s.tmp',
                \sys_get_temp_dir(),
                // Ранее мы сохраняли данные в файл вне зависимости какой php выполнялся,
                // но что если интерпритатор будут менятся,
                // то получается что мы можем подхватить данные другого интерпретатора,
                // формируя хеш мы от этого защитимся
                \Inilim\Tool\Method\Other\phpRuntimeFingerprint(),
                $flags
            );
            if ($fresh) {
                goto fresh;
            }
            \clearstatcache(false, $pathToFile);
            if (\is_file($pathToFile)) {
                $result = \file_get_contents($pathToFile);
                if (false === $result) {
                    goto fresh;
                }
                /** @var string $result */
                return $result;
            } else {
                fresh:
                $info = \Inilim\Tool\Method\Other\phpInfo($flags);
                if (null === $info) {
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
