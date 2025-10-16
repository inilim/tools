<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * Значительно экономит ОЗУ
 * @ext PDO pdo_sqlite
 * @psalm-import-type Return_findFromJsonViaSqlite from \TypeExp
 * @param string $json
 * @param callable(string|int $key, string|int|float|null $value, string $type, string $fullkey):bool $callable
 * @return Return_findFromJsonViaSqlite[]|null
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
            $pdo->sqliteCreateFunction('FN_FULLKEY', static function ($fullkey) {
                return \strtr($fullkey, ['$.' => '']);
            }, 1);
            $pdo->sqliteCreateFunction('FN_TYPE', static function ($type) {
                switch ($type) {
                    case 'real':
                        $type = 'float';
                        break;
                    case 'text':
                        $type = 'string';
                        break;
                    case 'integer':
                        $type = 'int';
                        break;
                    case 'true':
                    case 'false':
                        $type = 'bool';
                        break;
                }
                return $type;
            }, 1);
            $pdo->sqliteCreateFunction('FN_IS', static function ($key, $value, $type, $fullkey) use ($callable) {
                return (bool)$callable($key, $value, $type, $fullkey);
            }, 4);
            $stmt = $pdo->prepare('SELECT
                    tree.key, tree.value, FN_TYPE(tree.type) as type, FN_FULLKEY(tree.fullkey) as fullkey
                FROM _table, json_tree(_table._value) as tree
                WHERE
                    tree.key not null
                    AND FN_IS(tree.key, tree.value, FN_TYPE(tree.type), FN_FULLKEY(tree.fullkey))
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
