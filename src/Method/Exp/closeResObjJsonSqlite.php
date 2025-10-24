<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * @throws \InvalidArgumentException
 */
function closeResObjJsonSqlite(object $value): bool
{
    if (!\Inilim\Tool\Method\Exp\isResObjJsonSqlite($value)) {
        // TODO
        throw new \InvalidArgumentException('');
    }
    return \Inilim\Tool\Method\Other\bindAndCall($value, function () {
        $this->tag = '';
        $this->pdo = null;
        return \Inilim\Tool\Method\FS\unlink($this->tmpFile);
    });
}
