<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * INFO version берем из обьекта \PDO
 * @author inilim
 * @todo tests
 * @ext pdo pdo_sqlite
 */
function sqliteLibVersion_m3(): ?string
{
    \Inilim\Tool\Method\Assert\extPhp('PDO');
    \Inilim\Tool\Method\Assert\extPhp('pdo_sqlite');

    $internal = static function () {
        $pdo = new \PDO('sqlite::memory:', null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
        $stmt = $pdo->query('SELECT sqlite_version()', \PDO::FETCH_NUM);
        $result = $stmt->fetch();
        $pdo = $stmt = null;
        if (\is_array($result)) {
            return $result[0] ?? null;
        }
        return null;
    };

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2($internal);
    return \is_string($result) ? $result : null;
}
