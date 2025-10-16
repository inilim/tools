<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * Значительно экономит ОЗУ
 * @ext PDO pdo_sqlite
 *
 * @param string $json
 * @param callable(string $key, string $value, string $type, string $fullkey):bool $callable
 * @return (array{key:string,value:string,type:string,fullkey:string})[]|null
 */
function findFromJsonViaSqlite(string $json, callable $callable, int $limit = 10): ?array
{
    \Inilim\Tool\Method\Assert\extPhp('PDO');
    \Inilim\Tool\Method\Assert\extPhp('pdo_sqlite');
    \Inilim\Tool\Method\Assert\positiveInteger($limit);

    $results = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use ($json, $callable, $limit) {
            $pdo = new \PDO('sqlite::memory:', null, null, []);
            $pdo->exec('CREATE TABLE _table (_value TEXT)');
            $stmt = $pdo->prepare('INSERT INTO _table (_value) VALUES (:_value)');
            $stmt->execute(['_value' => $json]);
            unset($json);
            $stmt = $pdo->query('SELECT json_valid(_value) as valid FROM _table');
            $results = $stmt->fetch(\PDO::FETCH_NUM);
            if (!isset($results[0]) || $results[0] == 0) {
                $pdo = $stmt = null;
                \Inilim\Tool\Method\Other\__setErrorLast(-1, 'JSON invalid', '', -1);
                return null;
            }
            $results = null;
            $pdo->sqliteCreateFunction('FN_IS', static function ($key, $value, $type, $fullkey) use ($callable) {
                return (bool)$callable($key, $value, $type, \strtr($fullkey, ['$.' => '']));
            }, 4);
            $stmt = $pdo->prepare('SELECT
                    tree.key, tree.value, tree.type, tree.fullkey
                FROM _table, json_tree(_table._value) as tree
                WHERE
                    tree.key not null
                    AND FN_IS(tree.key, tree.value, tree.type, tree.fullkey)
                LIMIT :limit');
            $stmt->execute(['limit' => $limit]);
            $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $pdo = $stmt =  null;
            return $results;
        },
        static function ($_, $msg) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $msg, '', -1);
        }
    );

    if (!\is_array($results)) {
        return null;
    }
    return $results;
}
