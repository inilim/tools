<?php

declare(strict_types=1);

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

use Inilim\Tool\FS;
use Inilim\Tool\ID;
use Inilim\Tool\VD;
use Inilim\Tool\Arr;
use Inilim\Tool\Exp;
use Inilim\Tool\Obj;
use Inilim\Tool\Str;
use Inilim\Tool\Xml;
use Inilim\Tool\Zip;
use Inilim\Dump\Dump;
use Inilim\Tool\Data;
use Inilim\Tool\Enum;
use Inilim\Tool\File;
use Inilim\Tool\Json;
use Inilim\Tool\Path;
use Inilim\Tool\Refl;
use Inilim\Tool\Time;
use Inilim\Tool\Other;
use Inilim\Tool\Double;
use Inilim\Tool\Integer;
use Inilim\IPDO\IPDOSQLite;
use Composer\InstalledVersions;
use DragonCode\Benchmark\Benchmark;
use Inilim\Tool\Test\ForTest\ClassicClass;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

\ini_set('memory_limit', '5M');


__includeDeep([
    'Other\errorGetLast',
    'Exp\excelReadCellsBySheetId',
    'Exp\excelGetSheetsInfo',
    'Exp\excelReadCellsBySheetId_m2',
]);

// $res = \Inilim\Tool\Method\Exp\excelGenerateCellRange('D1:F18');
// de(\iterator_to_array($res));

// $file = 'C:\Users\work\Desktop\excel.xlsx';
$file = 'C:\Users\work\Desktop\Отчёт о партнёрах_РЭЧ_2025_РФ.xlsx';

// $count = \Inilim\Tool\Method\Exp\excelRemoveTmpFiles($file);
// if (\Inilim\Tool\Method\Other\errorGetLast()) {
//     de(\Inilim\Tool\Method\Other\errorGetLast());
// }
// de($count);

// $info = \Inilim\Tool\Method\Exp\excelGetSheetsInfo($file);
// if (\Inilim\Tool\Method\Other\errorGetLast()) {
//     de(\Inilim\Tool\Method\Other\errorGetLast());
// }
// de($info);

// $zip = \Inilim\Tool\Method\Zip\getObjFrom($file);
// de();

// $resource = \Inilim\Tool\Method\Exp\excelGetResourceSheetById($file, 'rId3');
// if (\Inilim\Tool\Method\Other\errorGetLast()) {
//     de(\Inilim\Tool\Method\Other\errorGetLast());
// }

// de(stream_get_meta_data($resource));


// de(\preg_replace('#^([a-z]+)(\d+)$#i', '$1-$2', 'AA21'));


// $db = __DIR__ . '/test.sqlite';
// d($db);
// if (!\Inilim\Tool\Method\FS\isFile($db)) {
//     \Inilim\Tool\Method\File\put($db, '');
//     $connect = new IPDOSQLite($db);
//     $connect->exec('CREATE TABLE IF NOT EXISTS cells (
//         value TEXT,
//         raw_value TEXT,
//         id NUMERIC UNIQUE ON CONFLICT REPLACE,
//         col_num NUMERIC,
//         type TEXT,
//         shared_id NUMERIC,
//         row_num NUMERIC
//     )');
// }
// $connect ??= new IPDOSQLite($db);
// [$lower, $trim] = Str::__asClosure('lower', 'trim');
// $connect->createFunction('MB_LOWER', static function ($value) use ($lower) {
//     return \is_string($value) ? $lower($value) : $value;
// }, 1);
// $connect->createFunction('NEW_TRIM', static function ($value) use ($trim) {
//     return \is_string($value) ? $trim($value) : $value;
// }, 1);

// $sqlInsert = 'INSERT INTO cells
// (value,raw_value,id,col_num,type,shared_id,row_index) VALUES
// ({value},{raw_value},{id},{col_num},{type},{shared_id},{row_index})';

// $connect->getPDO()->sqliteCreateCollation('TEST2', static function () {
//     dde(func_get_args());
// });
// $connect->getPDO()->sqliteCreateAggregate('TEST2', static function ($context, $rownumber, $value) {
//     de(func_get_args());
//     if ($context === null) {
//         $context = [];
//     }
//     $context[] = $value;
//     return $context;
// }, static function ($context) {
//     return \implode(',', $context);
// });


// $connect->exec('UPDATE cells SET value = MB_LOWER(value)');


// $res = $connect->exec('SELECT TEST2(id,row_index) FROM cells WHERE row_index = 1', 2);
// $connect->exec('UPDATE cells SET col_num = ID_TO_COL_NUM(id)');

// de();

// $res = $connect->exec('SELECT quote({value}) as value', ['value' => 'Муниципальное бюджетное дошкольное образовательное учреждение города Кургана «Центр развития ребенкадетский сад № 131 «Ветерок»'], 1);

// de($res);

$result = \Inilim\Tool\Method\Exp\excelReadCellsBySheetId_m2($file, 'rId13');
if (\Inilim\Tool\Method\Other\errorGetLast()) {
    de(\Inilim\Tool\Method\Other\errorGetLast());
}

if ($result) {

    $res = Other::timedMsCall(function () use ($result) {
        Other::iteratorToDevNull($result);
    });

    de($res);
}

de(\Inilim\Tool\Method\Other\errorGetLast());

// $connect->transaction(static function () use (&$cell, $sqlInsert, $connect) {
//     $connect->exec($sqlInsert, [
//         'value' => \in_array($cell['type'], ['string', 'formula'])
//             ? Str::trim(Str::lower($cell['value']))
//             : $cell['value'],
//         'raw_value' => $cell['raw_value'],
//         'id' => \Inilim\Tool\Method\Str\upper($cell['id']),
//         'col_num'   => $cell['col_num'],
//         'type'      => $cell['type'],
//         'shared_id' => $cell['shared_id'] ?? null,
//         'row_num'   => $cell['row_num'],
//     ]);
// });