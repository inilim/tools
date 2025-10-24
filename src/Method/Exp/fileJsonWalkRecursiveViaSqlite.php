<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * @build_skip
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @ext PDO pdo_sqlite
 * @psalm-import-type Return_findFromJsonViaSqlite from \TypeExp
 * @template B of mixed
 * @param null|positive-int $limit
 * @param ('object'|'array'|'int'|'string'|'float'|'bool'|'null')[] $types
 * @param B $valueBreak
 * @param string|object $pathToFile
 * @param callable(string|int $key, string|int|float|null|bool $value, string $type, string $fullkey):B $callback
 */
function fileJsonWalkRecursiveViaSqlite($pathToFile, callable $callback, ?int $limit = null, $valueBreak = false, array $types = []): ?string
{
    if (\is_string($pathToFile)) {
        $pathToFile = \Inilim\Tool\Method\Exp\openJsonViaSqlite($pathToFile);
        if ($pathToFile === null) {
            return null;
        }
    } else {
        if (!\Inilim\Tool\Method\Exp\isResObjJsonSqlite($pathToFile)) {
            throw new \InvalidArgumentException('The value is not a resource object for a json sqlite file');
        }
    }
    if ($limit !== null) {
        \Inilim\Tool\Method\Assert\positiveInteger($limit);
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

    $internal = static function ($obj) use ($pathToFile, $callback, $limit, $valueBreak, $types) {
        /** @var \stdClass $obj */



        // ---------------------------------------------
        // Поиск
        // ---------------------------------------------

        $obj->pdo->sqliteCreateFunction('FN_IT', static function ($key, $value, $type, $fullkey) use (&$limit, $callback, $valueBreak) {
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
            $obj->pdo->query($sql);
        } catch (\Exception $e) {
            $m = $e->getMessage();
            unset($e);
            if ($m !== 'ok') {
                \Inilim\Tool\Method\Other\__setErrorLast(-1, $m, '', -1);
                return false;
            }
        }
        return $obj->tmpFile;
    };

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        $internal,
        static function ($_, $msg, $_1, $_2, $context) {
            \Inilim\Tool\Method\Other\__setErrorLast(-1, $msg, '', -1);
            if ($context['isException']) {
                $obj = $context['obj'];
                $obj->pdo  = null;
                $obj->stmt = null;
                \Inilim\Tool\Method\FS\unlink($obj->tmpFile);
            }
        }
    );

    if (!\is_bool($result)) {
        return false;
    }
    return $tmpFile;
}
