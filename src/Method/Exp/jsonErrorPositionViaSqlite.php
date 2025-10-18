<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @see https://sqlite.org/json1.html#jerr
 * @author inilim
 * @ext PDO pdo_sqlite
 */
function jsonErrorPositionViaSqlite(string $json): ?int
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
        $stmt = $pdo->query('SELECT json_error_position(_value) as pos FROM _table');
        $results = $stmt->fetch(\PDO::FETCH_NUM);
        $pdo = $stmt = null;
        if (!isset($results[0]) || $results[0] == 0) {
            return true;
        }
        return (int)$results[0];
    };

    $results = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        $internal,
        static function ($_, $msg) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $msg, '', -1);
        }
    );
    if ($results === true || !\is_int($results)) {
        return null;
    }
    return $results;
}
