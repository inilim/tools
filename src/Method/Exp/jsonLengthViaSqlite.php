<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @see https://sqlite.org/json1.html#jarraylen
 * @ext PDO pdo_sqlite
 * @param string $pattern see https://sqlite.org/json1.html#jarraylen
 * @throws \InvalidArgumentException
 */
function jsonLengthViaSqlite(string $json, ?string $pattern = null): ?int
{
    if (!\Inilim\Tool\Method\Exp\jsonValidateViaSqlite($json)) {
        throw new \InvalidArgumentException('JSON invalid');
    }

    $internal = static function () use ($json, $pattern) {
        $pdo = new \PDO('sqlite::memory:', null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
        $pdo->exec('CREATE TABLE _table (_value TEXT)');
        $stmt = $pdo->prepare('INSERT INTO _table (_value) VALUES (:_value)');
        $stmt->execute(['_value' => $json]);
        unset($json);
        if ($pattern) {
            $stmt = $pdo->prepare('SELECT json_array_length((SELECT _value FROM _table LIMIT 1), :pattern) as _v');
            $stmt->execute(['pattern' => $pattern]);
        } else {
            $stmt = $pdo->prepare('SELECT json_array_length((SELECT _value FROM _table LIMIT 1)) as _v');
            $stmt->execute();
        }
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $result = $result['_v'] ?? null;
        if (\Inilim\Tool\Method\Integer\isNumeric($result)) {
            return (int)$result;
        }
        return null;
    };

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        $internal,
        static function ($_, $msg) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $msg, '', -1);
        }
    );

    if ($result === null || !\is_int($result)) {
        return null;
    }

    return $result;
}
