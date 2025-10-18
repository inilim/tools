<?php

declare(strict_types=1);

use Inilim\Tool\FS;
use Inilim\Tool\PF;
use Inilim\Tool\Arr;
use Inilim\Tool\Exp;
use Inilim\Tool\Lar;
use Inilim\Tool\File;
use Inilim\Tool\Json;
use Inilim\Tool\Other;
use Inilim\Tool\Test\CasePhpT;
use Inilim\Tool\Test\TestProcess;
use Inilim\Tool\Test\DefinePhpBin;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

\ini_set('memory_limit', '15M');

__includeDeep([
    // 'Other\phpInfoCache',
    // 'Other\phpInfo',
    'Exp::findFromJsonViaSqlite',
    'File::get',
    'Other::errorGetLast',
    'Exp::jsonWalkViaSqlite',
]);


['result' => $json] = \Inilim\Tool\Method\File\get('D:\projects\evg\other\afl\main.json');

\Inilim\Tool\Method\Exp\jsonWalkViaSqlite($json, static function ($key, $value, $type, $fuulkey) {
    \d($type);
}, 1, false, ['string']);





de();
// $result = \json_decode($json, true);
// $result = Lar::dataGet($result, 'NGRX_STATE.leagues.data.*');
// $result = \array_filter($result, static fn($v) => $v['city']['name'] === 'Moscow');
// $result = \array_values($result);
// \de($result);
$result = \Inilim\Tool\Method\Exp\findFromJsonViaSqlite($json, static function ($key, &$value, $type, $fullkey) {
    if ($type === 'object' && \str_starts_with($fullkey, '"NGRX_STATE".leagues.data[')) {
        $value = \json_decode($value, true);
        return ($value['city']['name'] ?? '') === 'Moscow';
    }
}, 2);

\d($result);
\dde(\Inilim\Tool\Method\Other\errorGetLast());

$result = Other::timedMsCall(static function () use ($json) {

    // $cls = Exp::__asClosure('findFromJsonViaSqlite');
    for ($i = 0; $i <= 1_000; $i++) {
        // $result = \json_decode($json, true);
        // $result = Lar::dataGet($result, 'NGRX_STATE.leagues.data.*');
        // $result = \array_filter($result, static fn($v) => $v['city']['name'] === 'Moscow');
        // $result = \array_values($result);


        // $result = Exp::findFromJsonViaSqlite($json, static function ($key, &$value, $type, $fullkey) {
        //     if ($type === 'object' && \str_starts_with($fullkey, '"NGRX_STATE".leagues.data')) {
        //         $value = \json_decode($value, true);
        //         return $value['city']['name'] === 'Moscow';
        //     }
        //     return false;
        // }, 100);
    }
});


\de($result);







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
