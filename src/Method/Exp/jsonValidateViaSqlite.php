<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @see https://sqlite.org/json1.html#the_json_valid_function
 * @author inilim
 * @param int $flags 1  - is RFC-8259 JSON text | 2  - is JSON5 text | 4  - is probably JSONB | 5  - is RFC-8259 JSON text or JSONB | 6  - is JSON5 text or JSONB ← This is probably the value you want | 8  - is strictly conforming JSONB | 9  - is RFC-8259 or strictly conforming JSONB | 10 - is JSON5 or strictly conforming JSONB
 * @ext PDO pdo_sqlite
 */
function jsonValidateViaSqlite(string $json, int $flags = 1): bool
{
    \Inilim\Tool\Method\Assert\extPhp('PDO');
    \Inilim\Tool\Method\Assert\extPhp('pdo_sqlite');
    \Inilim\Tool\Method\Assert\inArray($flags, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
    $curVer = \Inilim\Tool\Method\Other\sqliteLibVersion_m3();
    // TODO json_valid был встроен в версии 3.38.0
    if (!\version_compare($curVer ?? '0.0.0', '3.38.0', '>=')) {
        if ($curVer === null) {
            throw new \InvalidArgumentException('SQLite library version is not defined');
        }
        throw new \InvalidArgumentException(\sprintf('Your SQLite %s library version is lower than 3.38.0', $curVer));
    }
    /** @var string $curVer */

    $internal = static function () use ($json, $flags, $curVer) {
        $pdo = new \PDO('sqlite::memory:', null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
        if (\version_compare($curVer, '3.45.0', '>=')) {
            // TODO В SQLite 3.45.0 у json_valid() появился необязательный второй аргумент flags, который уточняет, что считать «валидным JSON» (например, разрешать JSON5/JSONB).
            $stmt = $pdo->prepare(\sprintf('SELECT json_valid(:json,%s) as valid', $flags));
        } else {
            $stmt = $pdo->prepare('SELECT json_valid(:json) as valid');
        }
        $stmt->execute(['json' => $json]);
        unset($json);
        $result = $stmt->fetch(\PDO::FETCH_NUM);
        $pdo = $stmt = null;
        if (!isset($result[0]) || $result[0] == 0) {
            return false;
        }
        return true;
    };

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2($internal);

    if (!\is_bool($result)) {
        return false;
    }
    return $result;
}
