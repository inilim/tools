<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * @psalm-assert-if-true object $value
 * @phpstan-assert-if-true object $value
 * проверяет что обьект является ресурсным для методов ***ViaSqlite();
 * @param mixed $value
 */
function isResObjJsonSqlite($value): bool
{
    if (
        !\is_object($value)
        ||
        !\Inilim\Tool\Method\PF\str_starts_with(\get_class($value), 'class@anonymous')
    ) {
        return false;
    }

    return \Inilim\Tool\Method\Other\bindAndCall($value, function () {
        // $file = $this->tmpFile ?? '';
        // \clearstatcache(false, $file);
        // $pdo = $this->pdo ?? null;

        return ($this->tag ?? '') === \Inilim\Tool\Method\Exp\__tagJsonSqlite()
            // &&
            // \is_string($file) && $file !== '' && \is_file($file)
            // &&
            // \is_object($pdo) && \get_class($pdo) === \PDO::class
            // 
        ;
    });
}
