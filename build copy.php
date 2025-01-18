<?php

require_once __DIR__ . '/vendor/autoload.php';

use Inilim\Dump\Dump;
use PhpParser\Parser;
use PhpParser\NodeFinder;
use Inilim\IPDO\IPDOSQLite;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use PhpCodeMinifier\PhpMinifier;
use PhpParser\Node\Stmt\Function_;
use PhpParser\PrettyPrinter\Standard;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\NodeVisitor\NameResolver;

Dump::init();

// ---------------------------------------------
// 
// ---------------------------------------------

$links = [
    [
        'method' => 'Inilim\Tool\Method\Arr',
        'tool'   => \Inilim\Tool\Arr::class,
        'path'   => __DIR__ . '/src/Method/Arr',
    ],
    [
        'method' => 'Inilim\Tool\Method\Integer',
        'tool'   => \Inilim\Tool\Integer::class,
        'path'   => __DIR__ . '/src/Method/Integer',
    ],
    [
        'method' => 'Inilim\Tool\Method\Double',
        'tool'   => \Inilim\Tool\Double::class,
        'path'   => __DIR__ . '/src/Method/Double',
    ],
    [
        'method' => 'Inilim\Tool\Method\Data',
        'tool'   => \Inilim\Tool\Data::class,
        'path'   => __DIR__ . '/src/Method/Data',
    ],
    [
        'method' => 'Inilim\Tool\Method\String',
        'tool'   => \Inilim\Tool\Str::class,
        'path'   => __DIR__ . '/src/Method/String',
    ],
    [
        'method' => 'Inilim\Tool\Method\Other',
        'tool'   => \Inilim\Tool\Other::class,
        'path'   => __DIR__ . '/src/Method/Other',
    ],
    [
        'method' => 'Inilim\Tool\Method\Json',
        'tool'   => \Inilim\Tool\Json::class,
        'path'   => __DIR__ . '/src/Method/Json',
    ],
];
$linksNamespace = \array_column($links, 'method', 'tool');
$linksDir       = \array_column($links, 'path', 'tool');
$ignoreFilesPattern = [
    '#^example.php$#i',
    '#^example*#i',
];

// ---------------------------------------------
// 
// ---------------------------------------------

$parser          = (new ParserFactory())->createForHostVersion();
$nodeFinder      = new NodeFinder;
$pretty          = new Standard;
$pathToDb        = __DIR__ . '/build_dev.sqlite';
$pathToSqlFiles  = __DIR__ . '/files/sql/dev/';
$dbDev           = new IPDOSQLite($pathToDb);
// $phpCodeMinifier = \PhpCodeMinifier\MinifierFactory::create();
$phpCodeMinifier = new PhpMinifier(
    new \PhpCodeMinifier\Validator\PhpFileValidator(),
    new \PhpCodeMinifier\PhpTokenizer()
);

// ---------------------------------------------
// Создание таблиц
// ---------------------------------------------

if (true) {
    \file_put_contents($pathToDb, '');

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    $dbDev->exec(
        \file_get_contents($pathToSqlFiles . 'methods.sql')
    );
    if (!$dbDev->status()) {
        de([
            'не удалось создать таблицу methods'
        ]);
    }
    $dbDev->exec(
        \file_get_contents($pathToSqlFiles . 'idx_methods_name.sql')
    );
    if (!$dbDev->status()) {
        de([
            'не удалось создать индекс idx_methods_name'
        ]);
    }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    $dbDev->exec(
        \file_get_contents($pathToSqlFiles . 'groups.sql')
    );
    if (!$dbDev->status()) {
        de([
            'не удалось создать таблицу groups'
        ]);
    }
    $dbDev->exec(
        \file_get_contents($pathToSqlFiles . 'idx_groups_method_id.sql')
    );
    if (!$dbDev->status()) {
        de([
            'не удалось создать индекс idx_groups_method_id'
        ]);
    }
    $dbDev->exec(
        \file_get_contents($pathToSqlFiles . 'idx_groups_id.sql')
    );
    if (!$dbDev->status()) {
        de([
            'не удалось создать индекс idx_groups_id'
        ]);
    }
}

// ------------------------------------------------------------------
// Первичный сбор методов
// ------------------------------------------------------------------

if (true) {

    (static function (
        array $linksDir,
        array $ignoreFilesPattern,
        array $linksNamespace,
        NodeFinder $nodeFinder,
        IPDOSQLite $dbDev,
        Parser $parser,
        Standard $pretty,
        PhpMinifier $phpCodeMinifier
    ) {

        $sqlAddMethod = 'INSERT INTO methods (name,code,namespace,path_to_file) VALUES ({name},{code},{namespace},{path_to_file});';

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        foreach ($linksDir as $toolNamespace => $dir) {
            unset($linksDir[$toolNamespace]);
            $files = \glob($dir . '\*.php');
            // \shuffle($files);
            foreach ($files as $idx => $pathToFile) {
                unset($files[$idx]);
                $results  = [];
                $nameFile = \basename($pathToFile);
                $name     = str_replace('.php', '', $nameFile);

                // ---------------------------------------------
                // INFO проверка на regex
                // ---------------------------------------------

                $skip = false;
                foreach ($ignoreFilesPattern as $regex) {
                    if (\preg_match($regex, $nameFile)) {
                        $skip = true;
                        break;
                    }
                }

                if ($skip) continue;

                // ---------------------------------------------
                // INFO парсим
                // ---------------------------------------------

                $code = \file_get_contents($pathToFile);
                $ast = $parser->parse($code);

                // ---------------------------------------------
                // Ищем функцию
                // ---------------------------------------------

                $function = $nodeFinder->findFirstInstanceOf($ast, Function_::class);
                unset($ast);
                if ($function === null) {
                    de([
                        '$nameFile' => $nameFile
                    ]);
                }

                // ---------------------------------------------
                // чистим функцию от комментариев
                // ---------------------------------------------

                $function->setDocComment(new \PhpParser\Comment\Doc(''));

                // ------------------------------------------------------------------
                // 
                // ------------------------------------------------------------------

                $code = $pretty->prettyPrint([$function]);
                $code = \sprintf(
                    'namespace %s %s',
                    $linksNamespace[$toolNamespace],
                    $code
                );

                // ---------------------------------------------
                // минифицируем код
                // ---------------------------------------------

                $code = $phpCodeMinifier->minifyString('<?php ' . $code);
                $code = replaceFirst('<?php ', '', $code);

                // ------------------------------------------------------------------
                // 
                // ------------------------------------------------------------------

                $dbDev->exec($sqlAddMethod, [
                    'name'         => $name,
                    'code'         => $code,
                    'namespace'    => $linksNamespace[$toolNamespace],
                    'path_to_file' => $pathToFile,
                ]);
                if (!$dbDev->status()) {
                    de([
                        'не удалось добавить метод',
                        $name
                    ]);
                }

                // ---------------------------------------------
                // 
                // ---------------------------------------------

            } // endforeach php file
        } // endforeach dir
    })->__invoke(
        $linksDir,
        $ignoreFilesPattern,
        $linksNamespace,
        $nodeFinder,
        $dbDev,
        $parser,
        $pretty,
        $phpCodeMinifier
    );
}

unset(
    $linksDir,
    $linksNamespace,
);

// ---------------------------------------------
// Сбор зависимостей методов
// ---------------------------------------------

if (false) {
    (static function (
        IPDOSQLite $dbDev,
        Parser $parser,
        NodeFinder $nodeFinder
    ) {
        // $methods = $dbDev->exec('SELECT * FROM methods WHERE name = "isTinyInt"', 2);
        $methods = $dbDev->exec('SELECT * FROM methods', 2);
        \shuffle($methods);
        $groupID = 1;

        foreach ($methods as $idx => $method) {
            unset($methods[$idx]);
            d('method: ' . $method['name']);

            // de($method['code']);

            // ---------------------------------------------
            // Ищем зависимости
            // ---------------------------------------------

            $deps     = [];
            $depsAs   = [
                \sprintf('%s\%s', $method['namespace'], $method['name']),
            ];

            while (true) {

                if (!$depsAs) break;

                $methodDepStr = \array_shift($depsAs);

                if (\in_array($methodDepStr, $deps)) {
                    continue;
                }

                $deps[] = $methodDepStr;
                // $deps   = \Inilim\Tool\Method\Arr\unique($deps);

                // ---------------------------------------------
                // 
                // ---------------------------------------------

                $methodDep = $dbDev->exec(
                    'SELECT * FROM methods WHERE name = {name} AND namespace = {namespace}',
                    [
                        'name'      => \basename($methodDepStr),
                        'namespace' => \dirname($methodDepStr),
                    ],
                    1
                );

                if (!$methodDep) {
                    de([
                        '$methodDep' => $methodDep,
                        '$methodDepStr' => $methodDepStr,
                    ]);
                }

                // ---------------------------------------------
                // 
                // ---------------------------------------------

                $ast = $parser->parse('<?php' . PHP_EOL . $methodDep['code']);

                if ($ast === null) {
                    de([
                        'ast',
                        '$method'    => $method,
                        '$methodDep' => $methodDep,
                        '$methodDepStr' => $methodDepStr,
                    ]);
                }

                $function = $nodeFinder->findFirstInstanceOf($ast, Function_::class);
                unset($ast);

                if ($function === null) {
                    de([
                        'метод не найден',
                        '$method'    => $method,
                        '$methodDep' => $methodDep,
                    ]);
                }

                $tDeps = $nodeFinder->findInstanceOf($function, FullyQualified::class);
                unset($function);
                $tDeps = \array_filter($tDeps, static function (FullyQualified $f) {
                    return \stripos($f->name, 'inilim\\Tool\\Method') === 0;
                });

                $tDeps = \array_column($tDeps, 'name');
                $tDeps = \array_values($tDeps);
                /** @var string[] $tDeps */

                // ---------------------------------------------
                // 
                // ---------------------------------------------

                if ($tDeps) {
                    $depsAs = \array_merge($depsAs, $tDeps);
                }
                $tDeps = [];

                // ---------------------------------------------
                // 
                // ---------------------------------------------
            } // endwhile

            // de($deps);

            if (!$deps) continue;

            // ---------------------------------------------
            // Добавляем в БД группу зависимостей
            // ---------------------------------------------

            if (!$dbDev->begin()) {
                de([
                    'begin',
                    __LINE__,
                    '$method'    => $method,
                    '$methodDep' => $methodDep,
                ]);
            }

            foreach ($deps as $dep) {
                $methodID = $dbDev->exec('SELECT id FROM methods WHERE name = {name} AND namespace = {namespace}', [
                    'name'      => \basename($dep),
                    'namespace' => \dirname($dep),
                ], 1)['id'];

                $dbDev->exec('INSERT INTO groups (id, method_id) VALUES ({id}, {method_id})', [
                    // 'id'        => $groupID,
                    'id'        => $method['id'],
                    'method_id' => $methodID,
                ]);

                if (!$dbDev->status()) {
                    de([
                        'Не удалось добавить запись для groups',
                    ]);
                }
            } // endforeach

            if (!$dbDev->commit()) {
                de([
                    'commit',
                    __LINE__,
                    '$method'    => $method,
                    '$methodDep' => $methodDep,
                ]);
            }

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            $groupID++;
        } // endforeach

        // ---------------------------------------------
        // 
        // ---------------------------------------------

    })->__invoke(
        $dbDev,
        $parser,
        $nodeFinder
    );
}

// ---------------------------------------------
// Создаем базу
// ---------------------------------------------

$pathToDb       = __DIR__ . '/build.sqlite';
$pathToSqlFiles = __DIR__ . '/files/sql/';
$db             = new IPDOSQLite($pathToDb);

if (false) {

    \file_put_contents($pathToDb, '');

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    $db->exec(
        \file_get_contents($pathToSqlFiles . 'methods.sql')
    );
    if (!$db->status()) {
        de([
            'не удалось создать таблицу methods'
        ]);
    }
    $db->exec(
        \file_get_contents($pathToSqlFiles . 'idx_methods_name.sql')
    );
    if (!$db->status()) {
        de([
            'не удалось создать индекс idx_methods_name'
        ]);
    }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    $db->exec(
        \file_get_contents($pathToSqlFiles . 'groups.sql')
    );
    if (!$db->status()) {
        de([
            'не удалось создать таблицу groups'
        ]);
    }
    $db->exec(
        \file_get_contents($pathToSqlFiles . 'idx_groups_method_id.sql')
    );
    if (!$db->status()) {
        de([
            'не удалось создать индекс idx_groups_method_id'
        ]);
    }
    $db->exec(
        \file_get_contents($pathToSqlFiles . 'idx_groups_id.sql')
    );
    if (!$db->status()) {
        de([
            'не удалось создать индекс idx_groups_id'
        ]);
    }
}

if (false) {

    $db->connect();

    $methods = $dbDev->exec('SELECT * FROM methods', 2);

    if (!$db->begin()) {
        de([
            'begin',
            __LINE__
        ]);
    }
    foreach ($methods as $method) {
        $db->exec('INSERT INTO methods (id,name,code,namespace) VALUES ({id},{name},{code},{namespace})', [
            'id'        => $method['id'],
            'name'      => $method['name'],
            'code'      => $method['code'],
            'namespace' => $method['namespace'],
        ]);
    }
    unset($methods, $method);
    if (!$db->commit()) {
        de([
            'commit',
            __LINE__
        ]);
    }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    $groups  = $dbDev->exec('SELECT * FROM groups', 2);

    if (!$db->begin()) {
        de([
            'begin',
            __LINE__
        ]);
    }
    foreach ($groups as $group) {
        $db->exec('INSERT INTO groups (id, method_id) VALUES ({id}, {method_id})', [
            'id'        => $group['id'],
            'method_id' => $group['method_id'],
        ]);
    }
    unset($groups, $group);
    if (!$db->commit()) {
        de([
            'commit',
            __LINE__
        ]);
    }

    $dbDev->exec('VACUUM;');
}
