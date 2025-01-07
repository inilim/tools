<?php

require __DIR__ . '/vendor/autoload.php';

use Inilim\Dump\Dump;
use Inilim\ParseLazyMethod\ParseFunction;
use Inilim\ParseLazyMethod\ResultParseFunction;
use Inilim\ParseLazyMethod\FormationFunctionAnnotation;

use Inilim\Tool\Arr;
use Inilim\Tool\Data;
use Inilim\Tool\Double;
use Inilim\Tool\Integer;
use Inilim\Tool\Json;
use Inilim\Tool\Other;
use Inilim\Tool\Str;
// php parser
use PhpParser\Error;
use PhpParser\ParserFactory;
use PhpParser\Node\Stmt\Function_;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\NodeFinder;

// ------------------------------------------------------------------
// 
// ------------------------------------------------------------------

Dump::init();

// ------------------------------------------------------------------
// 
// ------------------------------------------------------------------
$class = Str::class;

$file_doc    = \sprintf(__DIR__ . '/autodoc_%s.txt', \basename($class));
$ref_class   = new \ReflectionClass($class);
$ALIAS       = $ref_class->getConstant('ALIAS');
$NAMESPACE   = $ref_class->getConstant('NAMESPACE');
$PATH_TO_DIR = $ref_class->getConstant('PATH_TO_DIR');
$NAMESPACE   = '\\' . \trim($NAMESPACE, '\\');
unset($ref_class);
$count_alias = \array_count_values($ALIAS);
$flip_alias = \array_flip($ALIAS);

$parser = (new ParserFactory())->createForHostVersion();
$traverser = new NodeTraverser;
$traverser->addVisitor(new NameResolver);
$node_finder = new NodeFinder;
$s = new ParseFunction;
$fa = new FormationFunctionAnnotation;

$files = \glob($PATH_TO_DIR . '/*.php');

\file_put_contents($file_doc, '');

// ------------------------------------------------------------------
// 
// ------------------------------------------------------------------


$docs = [];
foreach ($files as $file) {

    $filename = \pathinfo($file, \PATHINFO_FILENAME);

    // ------------------------------------------------------------------
    // исключить файлы
    // ------------------------------------------------------------------

    if (\in_array($filename, ['example', '__state', '__compare'])) {
        continue;
    }

    // ------------------------------------------------------------------
    // 
    // ------------------------------------------------------------------

    $param = '@see ' . $NAMESPACE . '\\' . $filename . '()';

    // ------------------------------------------------------------------
    // 
    // ------------------------------------------------------------------


    // d($file);
    // $file = $files[77];
    $code = \file_get_contents($file);

    try {
        $ast = $parser->parse($code);
    } catch (Error $e) {
        \de([
            $e->getMessage(),
            '$e' => $e
        ]);
    }

    // ------------------------------------------------------------------
    // 
    // ------------------------------------------------------------------

    $ast   = $traverser->traverse($ast);
    $func = $node_finder->findFirstInstanceOf($ast, Function_::class);

    if ($func === null) {
        \de([
            'функция не найден',
            '$file' => $file,
        ]);
    }

    // ------------------------------------------------------------------
    // 
    // ------------------------------------------------------------------

    try {
        $res = $s->__invoke($func);
    } catch (\Exception $e) {
        \de([
            '$file' => $file,
            '$e'    => $e,
        ]);
    }

    // ------------------------------------------------------------------
    // Алиасы
    // ------------------------------------------------------------------

    if (\in_array($res->name, $ALIAS)) {

        if ($count_alias[$res->name] > 1) {
            // ------------------------------------------------------------------
            // если один метод под несколькоми именами
            // ------------------------------------------------------------------

            $tm = \array_filter($ALIAS, fn($m) => $m === $res->name);
            $tm = \array_keys($tm);

            foreach ($tm as $item) {
                $t = new ResultParseFunction(
                    $res->name, // $name
                    $res->return_type, // $return_type
                    $res->args, // $args
                    $res->comments, // $comments
                    $res->annotations, // $annotations
                );
                $docs[] = $fa->__invoke($t);
                $docs[] = $fa->__invoke($t, true);
                $docs[] = $param;
                $docs[] = '';
            }
        } else {

            $t = new ResultParseFunction(
                $flip_alias[$res->name], // $name
                $res->return_type, // $return_type
                $res->args, // $args
                $res->comments, // $comments
                $res->annotations, // $annotations
            );
            $docs[] = $fa->__invoke($t);
            $docs[] = $fa->__invoke($t, true);
            $docs[] = $param;
            $docs[] = '';
        }
    }

    // ------------------------------------------------------------------
    // исключить методы
    // ------------------------------------------------------------------

    if (\in_array($res->name, ['match_'])) {
        continue;
    }

    // ------------------------------------------------------------------
    // 
    // ------------------------------------------------------------------

    // @param ...
    // $docs[] = $fa->__invoke($res);
    // @param static ...
    $docs[] = $fa->__invoke($res, true);
    $docs[] = $param;
    $docs[] = '';
}

// ------------------------------------------------------------------
// 
// ------------------------------------------------------------------


$docs = \array_map(function ($doc) {
    return ' * ' . $doc;
}, $docs);

$docs = '/**' . PHP_EOL . \implode(PHP_EOL, $docs) . PHP_EOL . ' */';

\file_put_contents($file_doc, $docs, \FILE_APPEND);
de($docs);
