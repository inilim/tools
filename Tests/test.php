<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Inilim\Tool\Arr;
use Inilim\Tool\Str;
use Inilim\Dump\Dump;
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



$parser = (new ParserFactory())->createForHostVersion();
$ast = $parser->parse(file_get_contents('D:\projects\tools\src\Method\String\replaceArray.php'));
$node_finder = new NodeFinder;
$func = $node_finder->findFirstInstanceOf($ast, Function_::class);

// берем зависимые функции
$funcs = $node_finder->findInstanceOf($func, FullyQualified::class);
$funcs = \array_filter($funcs, function (FullyQualified $f) {
    return \stripos($f->name, 'inilim\\') !== false;
});

de($funcs);

// убираем комменты
$func->setDocComment(new \PhpParser\Comment\Doc(''));

de($func);
$prettir = new Standard();
echo $prettir->prettyPrint([$func]);

// $func->$traverser = new NodeTraverser;
// $traverser->addVisitor(new NameResolver);
// $traverser->traverse($ast);
