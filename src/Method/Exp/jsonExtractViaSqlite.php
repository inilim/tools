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
    \Inilim\Tool\Method\Assert\extPhp('pdo_sqlite');
    \Inilim\Tool\Method\Assert\extPhp('PDO');
    \Inilim\Tool\Method\Assert\strOrArr($pattern);
    if (!\is_array($pattern)) {
        $pattern = [$pattern];
    }
    \Inilim\Tool\Method\Assert\allString($pattern);

    $internal = static function () use ($json, $pattern) {
        $params = [
            'json' => &$json,
        ];
        unset($json);
        $list = [];
        $idx = 0;
        foreach ($pattern as $item) {
            $placeholder = ':_' . $idx++;
            $params[$placeholder] = $item;
            $list[] = $placeholder;
        }
        $list = \implode(',', $list);
        $pdo = new \PDO('sqlite::memory:', null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
        $stmt = $pdo->prepare(\sprintf('SELECT json_extract(:json, %s) as v', $list));
        unset($list);
        $stmt->execute($params);
        unset($params);
        $result = $stmt->fetch(\PDO::FETCH_NUM);
        $pdo = $stmt = null;
        return $result[0] ?? null;
    };

    return \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2($internal);
}
