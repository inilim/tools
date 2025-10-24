<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @see https://sqlite.org/json1.html#jex
 * @ext PDO pdo_sqlite
 * @param string|string[] $pattern see https://sqlite.org/json1.html#jex
 * @return mixed
 * @throws \InvalidArgumentException
 */
function jsonExtractViaSqlite(string $json, $pattern)
{
    if (!\Inilim\Tool\Method\Exp\jsonValidateViaSqlite($json)) {
        throw new \InvalidArgumentException('JSON invalid');
    }
    \Inilim\Tool\Method\Assert\strOrArr($pattern);
    if (!\is_array($pattern)) {
        $pattern = [$pattern];
    }
    \Inilim\Tool\Method\Assert\allString($pattern);
    $pattern = \array_values($pattern);

    $internal = static function () use ($json, $pattern) {
        $pdo = new \PDO('sqlite::memory:', null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
        $pdo->exec('CREATE TABLE _table (_name TEXT, _value TEXT)');
        $stmt = $pdo->prepare('INSERT INTO _table (_name, _value) VALUES ("json", :_value)');
        $stmt->execute(['_value' => $json]);
        unset($json);
        $sql = 'SELECT json_extract((SELECT _value FROM _table WHERE _name = "json"), %s) as _v';
        $list   = [];
        $params = [];
        foreach ($pattern as $idx => $item) {
            $placeholder = ':_' . $idx;
            $params[$placeholder] = $item;
            $list[] = $placeholder;
        }
        $list = \implode(',', $list);
        $sql = \sprintf($sql, $list);
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['_v'] ?? null;
    };

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        $internal,
        static function ($_, $msg) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $msg, '', -1);
        }
    );

    return $result;
}
