<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * Значительно экономит ОЗУ, но медленее чем json_decode()
 * @ext PDO pdo_sqlite
 * @template B of mixed
 * @param string $json
 * @param null|positive-int $limit
 * @param ('object'|'array'|'int'|'string'|'float'|'bool'|'null')[] $types
 * @param B $valueBreak
 * @param callable(string|int $key, string|int|float|null|bool $value, string $type, string $fullkey):B $callback
 */
function jsonWalkRecursiveViaSqlite(string $json, callable $callback, ?int $limit = null, $valueBreak = false, array $types = []): bool
{
    if ($limit !== null) {
        \Inilim\Tool\Method\Assert\positiveInteger($limit);
    }
    \Inilim\Tool\Method\Assert\extPhp('PDO');
    \Inilim\Tool\Method\Assert\extPhp('pdo_sqlite');
    $curVer = \Inilim\Tool\Method\Other\sqliteLibVersion_m3();
    // TODO json_tree был встроен в версии 3.38.0
    if (!\version_compare($curVer ?? '0.0.0', '3.38.0', '>=')) {
        if ($curVer === null) {
            throw new \InvalidArgumentException('SQLite library version is not defined');
        }
        throw new \InvalidArgumentException(\sprintf('Your SQLite %s library version is lower than 3.38.0', $curVer));
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
        $pdo = new \PDO('sqlite::memory:', null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);

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
        });

        // INFO Очень важно ставить равенство "FN_IT(...) = 1" иначе выборка начинает глючить
        // INFO "[key] not null" это весь json, его мы исключаем
        // INFO LIMIT не работает, функция FN_IT отрабатывает на все строки... Поэтому стоит кастыль ввиде исключения
        // INFO fetch тоже не работает если использовать FN_IT
        try {
            $stmt = $pdo->prepare('SELECT 1 FROM json_tree(:json)
                WHERE [key] not null ' . ($types ? \sprintf('AND [type] IN (%s)', $types) : '') . ' AND FN_IT([key], [value], [type], [fullkey]) = 1');

            $stmt->execute([
                'json' => &$json
            ]);
            unset($json);
        } catch (\Exception $e) {
            unset($json);
            if ($e->getMessage() !== 'ok') {
                $pdo = $stmt = null;
                throw $e;
            }
        }
        $pdo = $stmt = null;
        return true;
    };

    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2($internal);

    if (!\is_bool($result)) {
        return false;
    }
    return $result;
}
