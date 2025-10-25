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
use Inilim\Tool\Assert;
use Inilim\Tool\Test\CasePhpT;
use Inilim\Tool\Test\TestProcess;
use Inilim\Tool\Test\DefinePhpBin;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

\ini_set('memory_limit', '15M');

__includeDeep([
    // 'File::get',
    // 'Other::errorGetLast',
    // 'Exp::jsonWalkRecursiveViaSqlite',
    // 'Exp::jsonErrorPositionViaSqlite',
    // 'Exp\jsonExtractViaSqlite',
    // 'Assert\strOrArr',
    // 'Assert\allString',
    // 'Exp\jsonLengthViaSqlite',
    // 'Exp\openJsonViaSqlite',
    'Other\errorGetLast',
    // 'Other\timedMsCall',
    // 'File\toCharsGenerator',
    'File\toCharsGenerator_v2',
]);


$substr = "a\nбв\nгд";
$substr = \substr($substr, 0, 10);

$r = \preg_match(\sprintf('/.{%s}/su', 1), $substr, $match);

dd(error_get_last());
de($match);

$res = \tmpfile();
\fwrite($res, "a\nбв\nгд");
$ptf = \stream_get_meta_data($res)['uri'];

$callback = \Inilim\Tool\Method\File\toCharsGenerator_v2($ptf);
foreach ($callback() as $key => $value) {
    dd([
        '$key' => $key,
        '$value' => $value,
    ]);
}
if (\Inilim\Tool\Method\Other\errorGetLast()) {
    de(\Inilim\Tool\Method\Other\errorGetLast());
}

de(1323);

$a = "a\nбв\nгд";

$chunk = 1;
$substr = \substr($a, 2, 10);
$substr = \preg_match(\sprintf('/.{%s}/us', $chunk), $substr, $match);
dd($match);
$substr = $match[0];

dde($substr);

de();


$object = \Inilim\Tool\Method\Exp\openJsonViaSqlite('D:\projects\evg\other\afl\main.json');
if (\Inilim\Tool\Method\Other\errorGetLast()) {
    de(\Inilim\Tool\Method\Other\errorGetLast());
}
de($object);

// ['result' => $json] = \Inilim\Tool\Method\File\get('D:\projects\evg\other\afl\main.json');

// \Inilim\Tool\Method\Exp\jsonErrorPositionViaSqlite('{"key": "value", "invalid":}');
// $result = \Inilim\Tool\Method\Exp\jsonExtractViaSqlite('{"a":null,"b":"xyz"}', ['$.a', '$.b'], 'not found');
// $result = \Inilim\Tool\Method\Exp\jsonLengthViaSqlite('{"one":[1,2,3]}', '$.two');
// \Inilim\Tool\Method\Exp\jsonLengthViaSqlite('{"a":2,"c":[4,5,{"f":7}]}');

de();
if (\Inilim\Tool\Method\Other\errorGetLast()) {
    de(\Inilim\Tool\Method\Other\errorGetLast());
}
de($result);
// \Inilim\Tool\Method\Exp\jsonWalkRecursiveViaSqlite($json, static function ($key, $value, $type, $fuulkey) {
//     \d($type);
// }, 1, false, ['string']);





de();
