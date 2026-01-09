<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @build_skip
 * @author inilim
 * @ext PDO pdo_sqlite
 * @see https://sqlite.org/json1.html#jins
 */
function jsonInsertViaSqlite(string $json, string $pattern, $value): string
{
    \Inilim\Tool\Method\Assert\extPhp('pdo_sqlite');
    \Inilim\Tool\Method\Assert\extPhp('PDO');
    $curVer = \Inilim\Tool\Method\Other\sqliteLibVersion_m3();
    // TODO json_insert был встроен в версии 3.38.0
    if (!\version_compare($curVer ?? '0.0.0', '3.38.0', '>=')) {
        if ($curVer === null) {
            throw new \InvalidArgumentException('SQLite library version is not defined');
        }
        throw new \InvalidArgumentException(\sprintf('Your SQLite %s library version is lower than 3.38.0', $curVer));
    }

    $internal = static function () use ($json, $pattern, $value) {
        $pdo = new \PDO('sqlite::memory:', null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
        $stmt = $pdo->prepare('SELECT json_insert(:json,:pattern,:value) as v');
        $stmt->execute([
            'json' => &$json,
            'pattern' => $pattern,
            'value' => $value,
        ]);
        unset($json);
        $result = $stmt->fetch(\PDO::FETCH_NUM);
        $pdo = $stmt = null;
        return $result[0] ?? null;
    };

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2($internal);
    de($result);
    if (!\is_bool($result)) {
        return false;
    }
    return $result;
}
