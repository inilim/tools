<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * Значительно экономит ОЗУ, но медленее чем json_decode()
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
            $results = [];
            $pdo->sqliteCreateFunction('FN_IT', static function ($key, $value, $type, $fullkey) use ($callable, &$results) {
                // TODO $fullkey можно еще обработать, там имеются лишние кавычки
                $fullkey = \strtr($fullkey, ['$.' => '']);
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

                // INFO можно изменить $value по ссылке, экономя на map()
                if ((bool)$callable($key, $value, $type, $fullkey)) {
                    $results[] = [
                        'key'     => $key,
                        'value'   => $value,
                        'type'    => $type,
                        'fullkey' => $fullkey,
                    ];
                    return true;
                }
                return false;
            }, 4);

            // INFO "tree.key not null" это весь json, его мы исключаем
            // TODO нужно как то производить SELECT без получения результата
            $stmt = $pdo->prepare('SELECT 1 FROM _table, json_tree(_table._value) as tree
                WHERE
                    tree.key not null
                    AND FN_IT(tree.key, tree.value, tree.type, tree.fullkey)
                LIMIT :limit');
            $stmt->execute(['limit' => $limit]);
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
