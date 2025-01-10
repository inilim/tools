<?php

require_once __DIR__ . '/vendor/autoload.php';

use Inilim\Dump\Dump;
use Inilim\IPDO\IPDOSQLite;
use PhpParser\NodeFinder;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\PrettyPrinter\Standard;

Dump::init();

function test(array &$nameFullyQualified)
{
    $mToP = \array_column($GLOBALS['links'], 'path', 'method');
    foreach ($nameFullyQualified as $fn) {
        $nameFn          = \basename($fn);
        $namespaceMethod = \dirname($fn);
        $path            = $mToP[$namespaceMethod];
        $pathToFile      = $path . '/' . $nameFn;
        $code            = \file_get_contents($pathToFile);
        // 
    }
}

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

$pathToDb       = __DIR__ . '/build.sqlite';
$pathToSqlFiles = __DIR__ . '/files/sql/';
$parser         = (new ParserFactory())->createForHostVersion();
$nodeFinder     = new NodeFinder;
$pretty         = new Standard;

// ---------------------------------------------
// 
// ---------------------------------------------

\file_put_contents($pathToDb, '');
$db = new IPDOSQLite($pathToDb);
$sqlAddMethod = 'INSERT INTO methods (name,code,namespace) VALUES ({name},{code},{namespace});';
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

// ------------------------------------------------------------------
// 
// ------------------------------------------------------------------

foreach ($linksDir as $toolNamespace => $dir) {
    $files = \glob($dir . '\*.php');
    \shuffle($files);
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
        // ___
        // ------------------------------------------------------------------

        $code = $pretty->prettyPrint([$function]);
        $code = \sprintf(
            '%s { %s }',
            $linksNamespace[$toolNamespace],
            $code
        );

        // ------------------------------------------------------------------
        // ___
        // ------------------------------------------------------------------

        $db->exec($sqlAddMethod, [
            'name' => $name,
            'code' => $code,
            'namespace' => $linksNamespace[$toolNamespace],
        ]);
        if (!$db->status()) {
            de([
                'не удалось добавить метод',
                $name
            ]);
        }

        // ---------------------------------------------
        // Ищем зависимости
        // ---------------------------------------------

        // $deps = $nodeFinder->findInstanceOf($function, FullyQualified::class);
        // $deps = \array_filter($deps, static function (FullyQualified $f) {
        //     return \stripos($f->name, 'inilim\\') === 0;
        // });
        // $deps = \array_column($deps, 'name');
        // $deps = \array_values($deps);

        // test($deps);
        // de($deps);

        // ---------------------------------------------
        // 
        // ---------------------------------------------

    } // endforeach php file
} // endforeach dir





de();
// берем зависимые функции


de($func);



// $func->$traverser = new NodeTraverser;
// $traverser->addVisitor(new NameResolver);
// $traverser->traverse($ast);
