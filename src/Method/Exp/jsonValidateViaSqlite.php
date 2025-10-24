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

    $internal = static function () use ($json, $flags) {
        $pdo = new \PDO('sqlite::memory:', null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
        $pdo->exec('CREATE TABLE _table (_value TEXT)');
        $stmt = $pdo->prepare('INSERT INTO _table (_value) VALUES (:_value)');
        $stmt->execute(['_value' => $json]);
        unset($json);
        $stmt = $pdo->query(\sprintf('SELECT json_valid(_value,%s) as valid FROM _table', $flags));
        $results = $stmt->fetch(\PDO::FETCH_NUM);
        $pdo = $stmt = null;
        if (!isset($results[0]) || $results[0] == 0) {
            return false;
        }
        return true;
    };

    $results = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2($internal);

    if (!\is_bool($results)) {
        return false;
    }
    return $results;
}
