<?php

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

use PhpParser\Node;
use Inilim\Dump\Dump;
use Twig\Environment;
use PhpParser\NodeFinder;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use PhpParser\Node\NullableType;
use Twig\Loader\FilesystemLoader;
use PhpParser\Node\Stmt\Function_;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\PrettyPrinter\Standard;
use PhpParser\NodeVisitor\NameResolver;
use Inilim\Tool\Build\Helper;

function getAlias(string $class): array
{
    return (new \ReflectionClass($class))->getConstant('ALIAS');
}

class FunctionSignatureExtractor extends NodeVisitorAbstract
{
    private $signatures = [];

    function enterNode(Node $node)
    {
        if ($node instanceof Function_) {
            $this->signatures[] = $this->getFunctionSignature($node);
        } elseif ($node instanceof ClassMethod) {
            // $this->signatures[] = $this->getClassMethodSignature($node);
        }
    }

    private function getFunctionSignature(Function_ $node): string
    {
        $params = [];
        $pretty = new Standard;
        foreach ($node->params as $param) {
            $params[] = $pretty->prettyPrint([$param]);
        }
        $paramsString = implode(', ', $params);

        $return = '';
        if ($node->returnType instanceof NullableType) {
            $return = $node->returnType ? ': ?' . $node->returnType->type->name : '';
        } else {
            $return = $node->returnType ? ': ' . $node->returnType->name : '';
        }

        return \sprintf(
            'function %s(%s)%s',
            $node->name,
            $paramsString,
            $return,
        );
    }

    private function getClassMethodSignature(ClassMethod $node): string
    {
        $params = [];
        foreach ($node->params as $param) {
            $params[] = (string) $param;
        }
        $paramsString = \implode(', ', $params);
        $visibility = '';
        // if ($node->isPublic()) {
        //     $visibility = 'public ';
        // } elseif ($node->isProtected()) {
        //     $visibility = 'protected ';
        // } elseif ($node->isPrivate()) {
        //     $visibility = 'private ';
        // }
        return \sprintf(
            '%s function %s(%s)%s',
            $visibility,
            $node->name,
            $paramsString,
            ($node->returnType ? ': ' . $node->returnType->name : ''),
        );
    }

    function getSignatures(): array
    {
        return $this->signatures;
    }
}

// ------------------------------------------------------------------
// 
// ------------------------------------------------------------------

Dump::init();

// ------------------------------------------------------------------
// 
// ------------------------------------------------------------------

foreach (\glob(\DIR_ROOT . '/files/ide/*') as $file) {
    \unlink($file);
    \clearstatcache(false, $file);
}

// ------------------------------------------------------------------
// 
// ------------------------------------------------------------------

$links      = include \DIR_ROOT . '/files/links.php';

$parser      = (new ParserFactory())->createForHostVersion();
$traverser   = new NodeTraverser;
$traverser->addVisitor(new NameResolver);
$nodeFinder = new NodeFinder;
$pretty          = new Standard;
$twig = new Environment(
    new FilesystemLoader(\DIR_ROOT . '/files/template'),
    [
        'cache'            => \DIR_ROOT . '/files/cache',
        'debug'            => true,
        'auto_reload'      => true, // Если true, при каждом рендеринге шаблона Symfony сначала проверяет, изменился ли его исходный код с момента его компиляции. Если он изменился, шаблон автоматически компилируется заново.
        'strict_variables' => true, // Если установлено значение false, Twig будет молча игнорировать недопустимые переменные (переменные и/или атрибуты/методы, которые не существуют) и заменять их нулевым значением. Если установлено значение true, Twig вместо этого генерирует исключение (по умолчанию — false).
    ]
);

// ------------------------------------------------------------------
// 
// ------------------------------------------------------------------


foreach ($links as $link) {

    $fileFuncs = \glob($link['path'] . '/*.php');
    // \shuffle($fileFuncs);
    $fileDoc    = \sprintf(\DIR_ROOT . '/files/ide/%s.php', \basename($link['tool']));
    $alias      = getAlias($link['tool']);
    $alias      = \array_combine(\array_values($alias), \array_keys($alias));
    // ------------------------------------------------------------------
    // 
    // ------------------------------------------------------------------

    $result = [];
    foreach ($fileFuncs as $fileFunc) {
        $code = \file_get_contents($fileFunc);

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        if (\str_contains($code, '@skip_build') || \str_contains($code, '@build_skip')) {
            continue;
        }

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        $parseResult = $parser->parse($code);

        // ------------------------------------------------------------------
        // 
        // ------------------------------------------------------------------

        $parseResult = $traverser->traverse($parseResult);
        $func = $nodeFinder->findFirstInstanceOf($parseResult, Function_::class);

        if ($func === null) {
            \de([
                'функция не найден',
                '$fileFunc' => $fileFunc,
            ]);
        }

        $nameFunc = $func->name->name;

        if (\str_starts_with($nameFunc, '__')) {
            continue;
        }

        // ------------------------------------------------------------------
        // Берем phpdoc
        // ------------------------------------------------------------------

        $doc = $func->getDocComment() ?? '';
        if (!\is_string($doc)) {
            $doc = $doc->getText();
        }

        // ------------------------------------------------------------------
        // Получаем сигнатуру
        // ------------------------------------------------------------------

        $trav = new NodeTraverser;
        $trav->addVisitor(new NameResolver);
        $signatureExtractor = new FunctionSignatureExtractor;
        $trav->addVisitor($signatureExtractor);
        $trav->traverse($parseResult);
        $signature = $signatureExtractor->getSignatures()[0] ?? null;

        if ($signature === null) {
            \de([
                'не получили сигнатуру',
                '$fileFunc' => $fileFunc,
            ]);
        }

        $signature .= ' {}';

        // ------------------------------------------------------------------
        // 
        // ------------------------------------------------------------------

        if (isset($result[$func->name->name])) {
            de([
                'Повтор',
                $func->name->name,
                $link['tool']
            ]);
        }

        $result[$func->name->name] = [
            'signature' => $signature,
            'doc'       => $doc,
        ];

        // ------------------------------------------------------------------
        // Алиасы
        // ------------------------------------------------------------------

        // if ($link['nameClass'] === 'Json') {
        //     if ($alias) {
        //         d([
        //             '$fileFunc' => $fileFunc,
        //             '$alias' => $alias,
        //             '$func->name->name' => $func->name->name,
        //         ]);
        //     }
        // }

        if (isset($alias[$func->name->name])) {

            if (isset($result[$alias[$func->name->name]])) {
                de([
                    'Повтор - алиас',
                    $func->name->name,
                    $link['tool']
                ]);
            }

            $result[$alias[$func->name->name]] = [
                'signature' => \str_replace($func->name->name, $alias[$func->name->name], $signature),
                'doc'       => $doc,
            ];
        } // alias
    } // foreach ($fileFuncs as $fileFunc)

    $body = $twig->render('ide.twig', [
        'link'    => $link,
        'methods' => $result,
    ]);

    \file_put_contents($fileDoc, $body);

    // de();

    // ------------------------------------------------------------------
    // 
    // ------------------------------------------------------------------
} // foreach ($links as $link)
