<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * Значительно экономит ОЗУ, но медленее чем json_decode() minimum sqlite version 3.42.0
 * @see https://sqlite.org/json1.html#jerr
 * @author inilim
 * @todo tests
 * @ext PDO pdo_sqlite
 */
function jsonErrorPositionViaSqlite(string $json): ?int
{
    \Inilim\Tool\Method\Assert\extPhp('pdo_sqlite');
    \Inilim\Tool\Method\Assert\extPhp('PDO');
    // TODO PDO вроде бы может брать sqlite из ОС а не из php
    $curVer = \Inilim\Tool\Method\Other\sqliteLibVersion_m3();
    // TODO json_error_position был встроен в версии 3.42.0
    if (!\version_compare($curVer ?? '0.0.0', '3.42.0', '>=')) {
        if ($curVer === null) {
            throw new \InvalidArgumentException('SQLite library version is not defined');
        }
        throw new \InvalidArgumentException(\sprintf('Your SQLite %s library version is lower than 3.42.0', $curVer));
    }

    $internal = static function () use ($json) {
        $pdo = new \PDO('sqlite::memory:', null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
        $stmt = $pdo->prepare('SELECT json_error_position(:json) as p');
        $stmt->execute(['json' => &$json]);
        unset($json);
        $result = $stmt->fetch(\PDO::FETCH_NUM);
        $pdo = $stmt = null;
        if (!isset($result[0]) || $result[0] == 0) {
            return true;
        }
        return (int)$result[0];
    };

    $results = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2($internal);
    if ($results === true || !\is_int($results)) {
        return null;
    }
    return $results;
}
