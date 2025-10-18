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
    'File::get',
    'Other::errorGetLast',
    'Exp::jsonWalkRecursiveViaSqlite',
    'Exp::jsonErrorPositionViaSqlite',
    'Exp\jsonExtractViaSqlite',
    'Assert\strOrArr',
    'Assert\allString',
]);


['result' => $json] = \Inilim\Tool\Method\File\get('D:\projects\evg\other\afl\main.json');

// \Inilim\Tool\Method\Exp\jsonErrorPositionViaSqlite('{"key": "value", "invalid":}');
$result = \Inilim\Tool\Method\Exp\jsonExtractViaSqlite('{"a":null,"b":"xyz"}', ['$.a', '$.b'], 'not found');

if (\Inilim\Tool\Method\Other\errorGetLast()) {
    de(\Inilim\Tool\Method\Other\errorGetLast());
}
de($result);
// \Inilim\Tool\Method\Exp\jsonWalkRecursiveViaSqlite($json, static function ($key, $value, $type, $fuulkey) {
//     \d($type);
// }, 1, false, ['string']);





de();
