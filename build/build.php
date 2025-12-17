<?php

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

use PhpParser\Parser;
use Twig\Environment;
use PhpParser\NodeFinder;
use Inilim\IPDO\IPDOSQLite;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use Inilim\Tool\Build\Helper;
use PhpParser\Node\Stmt\Class_;
use PhpCodeMinifier\PhpMinifier;
use Twig\Loader\FilesystemLoader;
use PhpParser\Node\Stmt\Function_;
use PhpCodeMinifier\MinifierFactory;
use Inilim\Tool\Build\CommentVisitor;
use PhpParser\PrettyPrinter\Standard;
use PhpParser\Node\Name\FullyQualified;


// ---------------------------------------------
// 
// ---------------------------------------------

$links = include \DIR_ROOT . '/files/links.php';
/**
 * @var array{method:string,tool:string,nameClass:string,path:string,pathMin:string,pathToClass:string} $links
 */
$linksNamespace = \array_column($links, 'method', 'tool');
$linksDir       = \array_column($links, 'path', 'tool');
$ignoreFilesPattern = [
    '#^example.example#i',
    '#^example*#i',
];

// ---------------------------------------------
// 
// ---------------------------------------------

$switch          = true;
$parser          = (new ParserFactory())->createForHostVersion();
$traverser       = new NodeTraverser();
$traverser->addVisitor(new CommentVisitor);
$nodeFinder      = new NodeFinder;
$pretty          = new Standard;
$pathToDb        = \DIR_ROOT . '/files/build_dev.sqlite';
$pathToSqlFiles  = \DIR_ROOT . '/files/sql/';
$dbDev           = new IPDOSQLite($pathToDb);
$phpCodeMinifier = MinifierFactory::create();
$twig = new Environment(
    new FilesystemLoader(\DIR_ROOT . '/files/template'),
    [
        'cache'            => \DIR_ROOT . '/files/cache',
        'debug'            => true,
        'auto_reload'      => true, // Если true, при каждом рендеринге шаблона Symfony сначала проверяет, изменился ли его исходный код с момента его компиляции. Если он изменился, шаблон автоматически компилируется заново.
        'strict_variables' => true, // Если установлено значение false, Twig будет молча игнорировать недопустимые переменные (переменные и/или атрибуты/методы, которые не существуют) и заменять их нулевым значением. Если установлено значение true, Twig вместо этого генерирует исключение (по умолчанию — false).
    ]
);

// ---------------------------------------------
// Создание таблиц
// ---------------------------------------------

if ($switch || false) {
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

    d('Create DB tables');
}

// ------------------------------------------------------------------
// Первичный сбор методов
// ------------------------------------------------------------------

if ($switch || false) {

    (static function (
        array $linksDir,
        array $ignoreFilesPattern,
        array $linksNamespace,
        NodeFinder $nodeFinder,
        IPDOSQLite $dbDev,
        Parser $parser,
        Standard $pretty,
        PhpMinifier $phpCodeMinifier,
        NodeTraverser $traverser
    ) {

        $sqlAddMethod = 'INSERT INTO methods
            (name,code,code_raw,namespace,path_to_file,strict_types)
            VALUES
            ({name},{code},{code_raw},{namespace},{path_to_file},{strict_types});';

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        foreach ($linksDir as $toolNamespace => $dir) {
            unset($linksDir[$toolNamespace]);
            $files = \glob($dir . '\*.php');
            // \shuffle($files);
            foreach ($files as $idx => $pathToFile) {

                // ---------------------------------------------
                // 
                // ---------------------------------------------

                $code = \file_get_contents($pathToFile);

                if (\str_contains($code, '@skip_build') || \str_contains($code, '@build_skip')) {
                    unset($files[$idx]);
                    continue;
                }

                // ---------------------------------------------
                // 
                // ---------------------------------------------

                unset($files[$idx]);
                $results  = [];
                $nameFile = \basename($pathToFile);
                $name     = \str_replace('.php', '', $nameFile);

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

                $code_raw = $code;
                try {
                    $ast = $parser->parse($code);
                } catch (\Throwable $e) {
                    de([
                        $name,
                        $e->getMessage(),
                    ]);
                }

                // ---------------------------------------------
                // Ищем функцию
                // ---------------------------------------------

                $attr     = $nodeFinder->findFirstInstanceOf($ast, \PhpParser\Node\Attribute::class);
                $function = $nodeFinder->findFirstInstanceOf($ast, Function_::class);

                unset($ast);
                if ($function === null) {
                    de([
                        '$nameFile' => $nameFile
                    ]);
                }

                // ---------------------------------------------
                // Проверка сходства имен
                // ---------------------------------------------

                if ($function->name->name !== $name) {
                    de([
                        'Имя файла отличается от имени функции',
                        '$function->name->name' => $function->name->name,
                        '$name' => $name,
                        '$nameFile' => $nameFile
                    ]);
                }

                // ---------------------------------------------
                // Очистка функций от внутренних комментариев
                // ---------------------------------------------

                [$function] = $traverser->traverse([$function]);

                // ------------------------------------------------------------------
                // 
                // ------------------------------------------------------------------

                $code = $pretty->prettyPrint([$function]);

                // ---------------------------------------------
                // минифицируем код
                // ---------------------------------------------

                // Если есть аттрибут, то мы его не минифицируем.
                // TODO при минификации ставить перенос строки, для аттрибутов.
                if (!$attr) {
                    $code   = $phpCodeMinifier->minifyString('<?php ' . $code);
                    $code   = Helper::replaceFirst('<?php ', '', $code);
                }

                // ------------------------------------------------------------------
                // проверяем на strict_types
                // ------------------------------------------------------------------
                // declare(strict_types=1);

                $strict_types = 0;
                if (\preg_match('/declare\(strict_types=1\)/i', $code_raw)) {
                    $strict_types = 1;
                }

                // ---------------------------------------------
                // 
                // ---------------------------------------------

                $dbDev->exec($sqlAddMethod, [
                    'name'         => $name,
                    'code'         => $code,
                    'code_raw'     => $code_raw,
                    'namespace'    => $linksNamespace[$toolNamespace],
                    'path_to_file' => $pathToFile,
                    'strict_types' => $strict_types,
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

        d('Collecting methods');
    })->__invoke(
        $linksDir,
        $ignoreFilesPattern,
        $linksNamespace,
        $nodeFinder,
        $dbDev,
        $parser,
        $pretty,
        $phpCodeMinifier,
        $traverser
    );
}

unset(
    $linksDir,
    $linksNamespace,
);

// ---------------------------------------------
// Сбор зависимостей методов
// ---------------------------------------------

if ($switch || false) {
    (static function (
        IPDOSQLite $dbDev,
        Parser $parser,
        NodeFinder $nodeFinder
    ) {
        // $methods = $dbDev->exec('SELECT * FROM methods WHERE name = "isTinyInt"', 2);
        $methods = $dbDev->exec('SELECT * FROM methods', 2);
        // \shuffle($methods);
        $groupID = 1;

        foreach ($methods as $idx => $method) {
            unset($methods[$idx]);
            // d('method: ' . $method['name']);
            // de($method['code']);

            // ---------------------------------------------
            // Ищем зависимости
            // ---------------------------------------------

            $deps   = [];
            $depsAs = [
                \sprintf('%s\%s', $method['namespace'], $method['name']),
            ];

            // ---------------------------------------------
            // Берем зависимости из doc блока "@deps(...)"
            // ---------------------------------------------

            $depsAs = \array_merge($depsAs, Helper::getDepsFromDoc($method['code_raw']));

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
                        __LINE__,
                        '$method'       => $method,
                        '$methodDep'    => $methodDep,
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
                        __LINE__,
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
                        __LINE__,
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
                // Берем зависимости из doc блока "@deps(...)"
                // ---------------------------------------------

                $tDeps = \array_merge($tDeps, Helper::getDepsFromDoc($methodDep['code_raw']));

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
            } // endforeach $deps

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
        } // endforeach $methods

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        d('Collecting deps methods');
    })->__invoke(
        $dbDev,
        $parser,
        $nodeFinder
    );
}

// ------------------------------------------------------------------
// Очищаем папку от старых скриптов
// ------------------------------------------------------------------

if ($switch || false) {
    foreach ($links as $link) {
        foreach (\glob($link['pathMin'] . '/*.php') as $file) {
            \unlink($file);
            \clearstatcache(false, $file);
        }
    }

    d('Clear old bundles');
}

// ---------------------------------------------
// Формируем бандлы
// ---------------------------------------------

if ($switch || false) {
    (static function (
        NodeFinder $nodeFinder,
        IPDOSQLite $dbDev,
        Parser $parser,
        Standard $pretty,
        PhpMinifier $phpCodeMinifier,
        Environment $twig,
        array $links
    ) {

        $methods        = $dbDev->exec('SELECT * FROM methods', 2);
        $methods        = \array_map(static function ($m) {
            unset($m['code_raw']);
            return $m;
        }, $methods);
        $tool_method    = \array_column($links, 'tool', 'method');
        $pathMin_method = \array_column($links, 'pathMin', 'method');

        // \shuffle($methods);

        foreach ($methods as $method) {

            $pathToDir = $pathMin_method[$method['namespace']];

            // ------------------------------------------------------------------
            // 
            // ------------------------------------------------------------------

            $group = $dbDev->exec('SELECT * FROM groups WHERE id = {id} AND method_id != {id}', [
                'id' => $method['id'],
            ], 2);

            $result = '';
            if (!$group) {
                // Нет зависимостей
                $method['tool'] = $tool_method[$method['namespace']];

                $result = $twig->render('withoutDeps.twig', $method);
            } else {
                // Есть зависимости

                $deps = $dbDev->exec('SELECT * FROM methods WHERE id IN ({deps})', [
                    'deps' => \array_column($group, 'method_id')
                ], 2);

                $deps = \array_map(static function ($dep) use (&$tool_method) {
                    unset($dep['code_raw']);
                    $dep['tool'] = $tool_method[$dep['namespace']];
                    $dep['isMain'] = false;
                    return $dep;
                }, $deps);

                $mainNamespace = $method['tool'] = $tool_method[$method['namespace']];

                // ---------------------------------------------
                // Есть ли strict_types
                // ---------------------------------------------

                $strict_types = 1;
                foreach ($deps as $dep) {
                    if ($dep['strict_types'] == 0) {
                        $strict_types = 0;
                        break;
                    }
                }

                // ---------------------------------------------
                // гурппируем по namespace
                // ---------------------------------------------

                $method['isMain'] = true;
                \array_unshift($deps, $method);
                $newDeps = [];
                foreach ($deps as $dep) {
                    $newDeps[$dep['namespace']] ??= [];
                    $newDeps[$dep['namespace']][] = $dep;
                }
                $deps = $newDeps;
                unset($newDeps);

                // ---------------------------------------------
                // TODO добавить use ..., для сокращения
                // ---------------------------------------------

                $result = $twig->render('withDepsGroupNamespace.twig', [
                    // 'main' => $method,
                    'deps' => $deps,
                    'strict_types' => $strict_types,
                ]);
                $deps = [];
            }

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            if (!\is_dir($pathMin_method[$method['namespace']])) {
                \mkdir($pathMin_method[$method['namespace']]);
            }

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            \file_put_contents(\sprintf(
                '%s/%s.php',
                $pathToDir,
                $method['name'],
            ), $result);
        }

        d('Bundles regen');
    })->__invoke(
        $nodeFinder,
        $dbDev,
        $parser,
        $pretty,
        $phpCodeMinifier,
        $twig,
        $links,
    );
}

// ---------------------------------------------
// formation all.php
// ---------------------------------------------

if ($switch || false) {
    (static function (
        array $links,
        Environment $twig,
        NodeFinder $nodeFinder,
        Parser $parser,
        Standard $pretty
    ) {
        $pathToFile   = \DIR_ROOT . '/src/all.php';
        // $exists       = \is_file($pathToFile);
        // $countClasses = \sizeof($links);

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        // if (!$exists) {
        //     \file_put_contents($pathToFile, $twig->render('all.twig'));
        // }

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        // $code = \file_get_contents($pathToFile);

        // if (\substr_count($code, 'class') === $countClasses) {
        //     return;
        // }
        // unset($code, $countClasses, $exists);

        \file_put_contents($pathToFile, $twig->render('all.twig'));

        // ---------------------------------------------
        // Доп. классы
        // ---------------------------------------------

        $links = [
            [
                'pathToClass' => \DIR_ROOT . '/src/LazyMethodAbstract.php',
            ],
            [
                'pathToClass' => \DIR_ROOT . '/src/Num.php',
            ],
            ...$links,
        ];

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        foreach ($links as $link) {

            $code = \file_get_contents($link['pathToClass']);

            try {
                $ast = $parser->parse($code);
            } catch (\Throwable $e) {
                de([
                    __LINE__,
                    $link,
                    $e->getMessage(),
                ]);
            }

            // ---------------------------------------------
            // find class
            // ---------------------------------------------

            $class = $nodeFinder->findFirstInstanceOf($ast, Class_::class);
            unset($ast);
            if ($class === null) {
                de([
                    __LINE__,
                    $link,
                ]);
            }

            // ---------------------------------------------
            // чистим класс от комментариев
            // ---------------------------------------------

            $class->setDocComment(new \PhpParser\Comment\Doc(''));

            // ---------------------------------------------
            // 
            // ---------------------------------------------

            $code = $pretty->prettyPrint([$class]);
            $code = \str_replace('\Inilim\Tool\LazyMethodAbstract', 'LazyMethodAbstract', $code);

            // ---------------------------------------------
            // Дописываем
            // ---------------------------------------------

            // dde($code);
            \file_put_contents($pathToFile, "\n" . $code, \FILE_APPEND);
        } // endforeach

        d('File "all.php" regen');
    })->__invoke(
        $links,
        $twig,
        $nodeFinder,
        $parser,
        $pretty
    );
}
