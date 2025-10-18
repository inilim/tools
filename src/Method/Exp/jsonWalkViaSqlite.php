<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @ext PDO pdo_sqlite
 * @psalm-import-type Return_findFromJsonViaSqlite from \TypeExp
 * @template B of mixed
 * @param string $json
 * @param null|positive-int $limit
 * @param ('object'|'array'|'int'|'string'|'float'|'bool'|'null')[] $types
 * @param B $valueBreak
 * @param callable(string|int $key, string|int|float|null|bool $value, string $type, string $fullkey):B $callback
 */
function jsonWalkViaSqlite(string $json, callable $callback, ?int $limit = null, $valueBreak = null, array $types = []): bool
{
    if ($limit !== null) {
        \Inilim\Tool\Method\Assert\positiveInteger($limit);
    }
    if (!\Inilim\Tool\Method\Exp\jsonValidateViaSqlite($json)) {
        \Inilim\Tool\Method\Other\__setErrorLast(-1, 'JSON invalid', '', -1);
        return false;
    }
    if ($types) {
        \Inilim\Tool\Method\Assert\allInArray($types, ['bool', 'string', 'int', 'float', 'null', 'object', 'array']);
        foreach ($types as &$type) {
            switch ($type) {
                case 'float':
                    $type = 'real';
                    break;
                case 'string':
                    $type = 'text';
                    break;
                case 'int':
                    $type = 'integer';
                    break;
                case 'bool':
                    $type = 'true';
                    // INFO это создает лишнюю итерацию
                    $types[] = 'false';
                    break;
            }
        }
        $types = \array_map(static fn($t) => '"' . $t . '"', $types);
    }
    $types = \implode(',', $types);

    $internal = static function () use ($json, $callback, $limit, $valueBreak, $types) {
        $pdo = new \PDO('sqlite::memory:', null, null, []);
        $pdo->exec('CREATE TABLE _table (_value TEXT)');
        $stmt = $pdo->prepare('INSERT INTO _table (_value) VALUES (:_value)');
        $stmt->execute(['_value' => $json]);
        unset($json, $stmt);
        $pdo->sqliteCreateFunction('FN_IT', static function ($key, $value, $type, $fullkey) use (&$limit, $callback, $valueBreak) {
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
                    $value = (bool)$value;
                    $type = 'bool';
                    break;
            }

            // INFO можно изменить $value по ссылке, экономя на последующий map()
            if ($callback($key, $value, $type, $fullkey) === $valueBreak) {
                throw new \Exception('ok');
            }

            if ($limit !== null) {
                $limit--;
                if ($limit <= 0) {
                    throw new \Exception('ok');
                }
            }

            return true;
        }, 4);

        $sql = 'SELECT 1 FROM _table, json_tree(_table._value) as tree
        WHERE tree.key not null ' . ($types ? \sprintf('AND tree.type IN (%s)', $types) : '') . ' AND FN_IT(tree.key, tree.value, tree.type, tree.fullkey) = 1';

        // INFO Очень важно ставить равенство "FN_IT(...) = 1" иначе выборка начинает глючить
        // INFO "tree.key not null" это весь json, его мы исключаем
        // INFO LIMIT не работает, функция FN_IT отрабатывет на все строки... Поэтому стоит кастыль ввиде исключения
        // INFO fetch тоже не работает если использовать FN_IT
        try {
            $pdo->query($sql);
        } catch (\Exception $e) {
            $m = $e->getMessage();
            unset($e);
            if ($m !== 'ok') {
                \Inilim\Tool\Method\Other\__setErrorLast(-1, $m, '', -1);
                return false;
            }
        }
        return true;
    };

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        $internal,
        static function ($_, $msg) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $msg, '', -1);
        }
    );

    if (!\is_bool($result)) {
        return false;
    }
    return $result;
}
