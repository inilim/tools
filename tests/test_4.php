<?php

declare(strict_types=1);

use Inilim\Tool\FS;
use Inilim\Tool\PF;
use Inilim\Tool\Arr;
use Inilim\Tool\Exp;
use Inilim\Tool\File;
use Inilim\Tool\Json;
use Inilim\Tool\Other;
use Inilim\Tool\Test\CasePhpT;
use Inilim\Tool\Test\TestProcess;
use Inilim\Tool\Test\DefinePhpBin;
use Symfony\Component\Finder\Finder;


require_once \dirname(__DIR__) . '/bootstrap.dev.php';

\ini_set('memory_limit', '5M');

// __includeDeep([
// 'Other\phpInfoCache',
// 'Other\phpInfo',
// ]);


// $.packages[0]."require-dev"."ext-pdo"
function getValueFromJsonByPattern(string $json)
{
    // \Inilim\Tool\Method\Assert\extPhp('PDO');
    // \Inilim\Tool\Method\Assert\extPhp('pdo_sqlite');

    // $file = \tmpfile();
    // $path = \stream_get_meta_data($file)['uri']; // eg: /tmp/phpFx0513a
    // dd($path);

    // :memory:
    // $pdo = new \PDO('sqlite:' . $path, null, null, []);
    $pdo = new \PDO('sqlite::memory:', null, null, []);
    $pdo->exec('CREATE TABLE _table (_value TEXT)');
    $stmt = $pdo->prepare('INSERT INTO _table (_value) VALUES (:_value)');
    $stmt->execute(['_value' => $json]);
    $stmt = $pdo->query('SELECT json_valid(_value) as valid FROM _table');
    $results = $stmt->fetch(\PDO::FETCH_NUM);
    if (!isset($results[0]) || $results[0] == 0) {
        return null;
    }
    dd($results);
    $results = null;
    $callback = static function ($path) {
        return \is_string($path) && \preg_match('/^packages\[\d+\]\.name$/', \strtr($path, ['$.' => ''])) ? true : false;
    };
    $pdo->sqliteCreateFunction('FN_IS', $callback, 1);
    $sql = 'SELECT
            tree.key,tree.value,tree.type,fullkey
        FROM _table, json_tree(_table._value) as tree
        WHERE FN_IS(tree.fullkey)';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    $pdo = $stmt =  null;
    // \fclose($file);
    // unlink($path);
    d($results);
}

$json = File::get('D:\projects\tools\vendor\composer\installed.json');
// $json = File::json('D:\projects\tools\vendor\composer\installed.json');
getValueFromJsonByPattern($json['result']);


deUsage();













de();
$finder = new Finder;
$finder->depth(1)->directories()->in('D:\projects\tools\vendor');


foreach ($finder as $dir => $_) {
    d($dir);
}



de();
$f = (function () {
    self::getRootPackage();
    return isset(self::$installed) ? self::$installed : null;
})->bindTo(null, \Composer\InstalledVersions::class)->__invoke();
de($f);

de([\Composer\InstalledVersions::class, 'getInstalledPackages']());
// $res = FS::phpGlob(__DIR__);
// $res = FS::phpGlob('');


dde($res);

de();
$a = new \DivisionByZeroError;

de();

// 9223372036854775807 + 1000
// 9223372036854776000

// dd(\strval(\PHP_INT_MIN));
// dd(\strval(-9223372036854775808));
// dd(\strval(-9223372036854775807));

dd(\sprintf('%.0f', '1.2'));


de();
// $str_decrement = PF::__asClosure('str_decrement');

$i = 0;
while (true) {
    $strI = \strval($i);
    $i++;
    // if (($r = $str_decrement($strI)) !== \strval($i)) {
    if (($r = \str_increment($strI)) !== \strval($i)) {
        echo \sprintf('str_increment("%s"); // "%s"', $strI, $r) . PHP_EOL;
    }

    if ($i >= 100_000_000) {
        break;
    }
}


de();





// de(PF::str_decrement('9999'));
de(\str_decrement('1999999990'));


de();
$code = File::get('D:\projects\tools\src\Method\Arr\where.php');

$tokens = \token_get_all($code['result']);
de($tokens);


$files = new Finder;
$files->files()->in(__DIR__ . '/files')->name(['*.xlsx']);
foreach (CasePhpT::self()->cases([Exp::class, 'excelGetSheetsInfo']) as $case) {
    foreach ($files as $file => $_) {
        $asserts = (new TestProcess($case))->withPhp('7.4')->withEnv('file', $file)->run();
        de($asserts);
        foreach ($asserts as $assert) {
        }
    }
}


// de(ini_get_all());
de([
    'php_ini_loaded_file'   => \php_ini_loaded_file(),
    'php_ini_scanned_files' => \php_ini_scanned_files(),
    'get_loaded_extensions' => \get_loaded_extensions(),
    // 'ini_get_all' => \ini_get_all(),
    'cli_get_process_title' => \cli_get_process_title(),
]);

de();
$a = new DefinePhpBin;
$a->definePhpBin();
de($a->getPhpBin());
