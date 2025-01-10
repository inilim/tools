<?php

require_once __DIR__ . '/vendor/autoload.php';

use Inilim\Tool\Arr;
use Inilim\Tool\Str;
use Inilim\Dump\Dump;
use Inilim\IPDO\IPDOSQLite;
use Inilim\Tool\Data;
use Inilim\Tool\Json;
use Inilim\Tool\Other;
use Inilim\Tool\Double;
use Inilim\Tool\Integer;
use PhpParser\NodeFinder;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\PrettyPrinter\Standard;

Dump::init();

function test(string $nameFullyQualified)
{
    // 
}

// ---------------------------------------------
// 
// ---------------------------------------------

$linksNamespace = [
    \Inilim\Tool\Arr::class     => 'Inilim\Tool\Method\Arr',
    \Inilim\Tool\Integer::class => 'Inilim\Tool\Method\Integer',
    \Inilim\Tool\Double::class  => 'Inilim\Tool\Method\Double',
    \Inilim\Tool\Data::class    => 'Inilim\Tool\Method\Data',
    \Inilim\Tool\Str::class     => 'Inilim\Tool\Method\String',
    \Inilim\Tool\Other::class   => 'Inilim\Tool\Method\Other',
    \Inilim\Tool\Json::class    => 'Inilim\Tool\Method\Json',
];
$linksDir = [
    \Inilim\Tool\Arr::class     => __DIR__ . '\src\Method\Arr',
    \Inilim\Tool\Integer::class => __DIR__ . '\src\Method\Integer',
    \Inilim\Tool\Double::class  => __DIR__ . '\src\Method\Double',
    \Inilim\Tool\Data::class    => __DIR__ . '\src\Method\Data',
    \Inilim\Tool\Str::class     => __DIR__ . '\src\Method\String',
    \Inilim\Tool\Other::class   => __DIR__ . '\src\Method\Other',
    \Inilim\Tool\Json::class    => __DIR__ . '\src\Method\Json',
];
$ignoreFilesPattern = [
    '#^example.php$#i',
    '#^example*#i',
];

// ---------------------------------------------
// 
// ---------------------------------------------

$pathToDb   = __DIR__ . '/build.sqlite';
$parser     = (new ParserFactory())->createForHostVersion();
$nodeFinder = new NodeFinder;
$pretty     = new Standard;

// ---------------------------------------------
// 
// ---------------------------------------------

\file_put_contents($pathToDb, '');
$db = new IPDOSQLite($pathToDb);

// ------------------------------------------------------------------
// 
// ------------------------------------------------------------------

foreach ($linksDir as $dir) {
    foreach (\glob($dir . '\*.php') as $pathToFile) {
        $results = [];
        $name    = \basename($pathToFile);

        // ---------------------------------------------
        // INFO проверка на regex
        // ---------------------------------------------

        $skip = false;
        foreach ($ignoreFilesPattern as $regex) {
            if (\preg_match($regex, $name)) {
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
                '$name' => $name
            ]);
        }

        // ---------------------------------------------
        // чистим функцию от комментариев
        // ---------------------------------------------

        $function->setDocComment(new \PhpParser\Comment\Doc(''));

        // ---------------------------------------------
        // Ищем зависимости
        // ---------------------------------------------

        $deps = $nodeFinder->findInstanceOf($function, FullyQualified::class);
        $deps = \array_filter($deps, function (FullyQualified $f) {
            return \stripos($f->name, 'inilim\\') !== false;
        });
        $deps = \array_values($deps);

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        de($deps);
    } // endforeach php file
} // endforeach dir





de();
// берем зависимые функции


de($func);

echo $pretty->prettyPrint([$func]);

// $func->$traverser = new NodeTraverser;
// $traverser->addVisitor(new NameResolver);
// $traverser->traverse($ast);
