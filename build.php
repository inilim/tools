<?php

require_once __DIR__ . '/vendor/autoload.php';

use Inilim\Dump\Dump;
use PhpParser\Parser;
use PhpParser\NodeFinder;
use Inilim\IPDO\IPDOSQLite;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use PhpCodeMinifier\PhpMinifier;
use PhpParser\Comment\Doc;
use PhpParser\Comment;
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
        'pathToMin'   => __DIR__ . '/src/MethodMin/Arr',
    ],
    [
        'method' => 'Inilim\Tool\Method\Integer',
        'tool'   => \Inilim\Tool\Integer::class,
        'path'   => __DIR__ . '/src/Method/Integer',
        'pathToMin'   => __DIR__ . '/src/MethodMin/Integer',
    ],
    [
        'method' => 'Inilim\Tool\Method\Double',
        'tool'   => \Inilim\Tool\Double::class,
        'path'   => __DIR__ . '/src/Method/Double',
        'pathToMin'   => __DIR__ . '/src/MethodMin/Double',
    ],
    [
        'method' => 'Inilim\Tool\Method\Data',
        'tool'   => \Inilim\Tool\Data::class,
        'path'   => __DIR__ . '/src/Method/Data',
        'pathToMin'   => __DIR__ . '/src/MethodMin/Data',
    ],
    [
        'method' => 'Inilim\Tool\Method\String',
        'tool'   => \Inilim\Tool\Str::class,
        'path'   => __DIR__ . '/src/Method/String',
        'pathToMin'   => __DIR__ . '/src/MethodMin/String',
    ],
    [
        'method' => 'Inilim\Tool\Method\Other',
        'tool'   => \Inilim\Tool\Other::class,
        'path'   => __DIR__ . '/src/Method/Other',
        'pathToMin'   => __DIR__ . '/src/MethodMin/Other',
    ],
    [
        'method' => 'Inilim\Tool\Method\Json',
        'tool'   => \Inilim\Tool\Json::class,
        'path'   => __DIR__ . '/src/Method/Json',
        'pathToMin'   => __DIR__ . '/src/MethodMin/Json',
    ],
];
$linksNamespace = \array_column($links, 'method', 'tool');
$linksDir       = \array_column($links, 'path', 'tool');
$linksDirMin    = \array_column($links, 'pathToMin', 'tool');
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
        PhpMinifier $phpCodeMinifier,
        $linksDirMin
    ) {

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

                $code = \file_get_contents($pathToFile);

                // ---------------------------------------------
                // Очищаем от комментариев
                // ---------------------------------------------

                $newCode  = '';
                $commentTokens = [\T_COMMENT];
                if (\defined('T_DOC_COMMENT')) {
                    $commentTokens[] = \T_DOC_COMMENT; // PHP 5
                }
                if (\defined('T_ML_COMMENT')) {
                    $commentTokens[] = \T_ML_COMMENT;  // PHP 4
                }
                $tokens = \token_get_all($code);

                foreach ($tokens as $token) {
                    if (\is_array($token)) {
                        if (\in_array($token[0], $commentTokens)) {
                            continue;
                        }
                        $token = $token[1];
                    }
                    $newCode .= $token;
                }
                unset($commentTokens, $tokens, $token);

                $code = $newCode;
                unset($newCode);

                // ---------------------------------------------
                // 
                // ---------------------------------------------

                $ast = $parser->parse($code);
                $code = $pretty->prettyPrint($ast);
                unset($ast);

                // ---------------------------------------------
                // минифицируем код
                // ---------------------------------------------

                $code = $phpCodeMinifier->minifyString('<?php ' . $code);

                // ---------------------------------------------
                // 
                // ---------------------------------------------

                \file_put_contents($linksDirMin[$toolNamespace] . '/' . $nameFile, $code);

                // ------------------------------------------------------------------
                // 
                // ------------------------------------------------------------------

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
        $phpCodeMinifier,
        $linksDirMin
    );
}

unset(
    $linksDir,
    $linksNamespace,
);
