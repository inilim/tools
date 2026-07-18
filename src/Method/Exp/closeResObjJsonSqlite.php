<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 */
function closeResObjJsonSqlite(object $value): bool
{
    if (!\Inilim\Tool\Method\Exp\isResObjJsonSqlite($value)) {
        return false;
    }
    return \Inilim\Tool\Method\Other\bindAndCall($value, function (): bool {
        if ($this->tag === '') {
            return false;
        }
        $this->tag = '';
        $this->pdo = null;
        return \Inilim\Tool\Method\FS\unlink($this->tmpFile);
    });
}
