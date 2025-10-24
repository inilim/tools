<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @author inilim
 * @ext PDO pdo_sqlite
 */
function jsonValidateViaSqlite(string $json): bool
{
    \Inilim\Tool\Method\Assert\extPhp('PDO');
    \Inilim\Tool\Method\Assert\extPhp('pdo_sqlite');

    $internal = static function () use ($json) {
        $pdo = new \PDO('sqlite::memory:', null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
        $pdo->exec('CREATE TABLE _table (_value TEXT)');
        $stmt = $pdo->prepare('INSERT INTO _table (_value) VALUES (:_value)');
        $stmt->execute(['_value' => $json]);
        unset($json);
        $stmt = $pdo->query('SELECT json_valid(_value) as valid FROM _table');
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
