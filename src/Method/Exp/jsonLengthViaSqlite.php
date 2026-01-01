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
    \Inilim\Tool\Method\Assert\extPhp('PDO');
    \Inilim\Tool\Method\Assert\extPhp('pdo_sqlite');
    $curVer = \Inilim\Tool\Method\Other\sqliteLibVersion_m3();
    // TODO json_array_length был встроен в версии 3.38.0
    if (!\version_compare($curVer ?? '0.0.0', '3.38.0', '>=')) {
        if ($curVer === null) {
            throw new \InvalidArgumentException('SQLite library version is not defined');
        }
        throw new \InvalidArgumentException(\sprintf('Your SQLite %s library version is lower than 3.38.0', $curVer));
    }

    $internal = static function () use ($json, $pattern) {
        $pdo = new \PDO('sqlite::memory:', null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
        if ($pattern) {
            $stmt = $pdo->prepare('SELECT json_array_length(:json, :pattern) as v');
            $stmt->execute([
                'json' => &$json,
                'pattern' => $pattern
            ]);
        } else {
            $stmt = $pdo->prepare('SELECT json_array_length(:json) as v');
            $stmt->execute([
                'json' => &$json,
            ]);
        }
        unset($json);
        $result = $stmt->fetch(\PDO::FETCH_NUM);
        $pdo = $stmt = null;
        $result = $result[0] ?? null;
        if (\Inilim\Tool\Method\Integer\isNumeric($result)) {
            return (int)$result;
        }
        return null;
    };

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2($internal);

    if ($result === null || !\is_int($result)) {
        return null;
    }

    return $result;
}
