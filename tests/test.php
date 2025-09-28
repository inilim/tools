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





__includeDeep([
    'Exp\excelReadRowsById',
    'Other\errorGetLast',
    'PF\str_ends_with',
    'Xml\toXml',
    'File\put',
    'Exp\excelGenerateCellRange',
    'Exp\excelRemoveTmpFiles',
    'Exp\excelGetResourceSheetById',
    'Exp\excelGetSheetsInfo',
]);


// $res = \Inilim\Tool\Method\Exp\excelGenerateCellRange('D1:F18');
// de(\iterator_to_array($res));

$file = 'C:\Users\work\Desktop\excel.xlsx';


$info = \Inilim\Tool\Method\Exp\excelGetSheetsInfo($file);
if (\Inilim\Tool\Method\Other\errorGetLast()) {
    de(\Inilim\Tool\Method\Other\errorGetLast());
}
de($info);

// $zip = \Inilim\Tool\Method\Zip\getObjFrom($file);
// de();

// $resource = \Inilim\Tool\Method\Exp\excelGetResourceSheetById($file, 'rId3');
// if (\Inilim\Tool\Method\Other\errorGetLast()) {
//     de(\Inilim\Tool\Method\Other\errorGetLast());
// }

// de(stream_get_meta_data($resource));

$gen = \Inilim\Tool\Method\Exp\excelReadRowsById($file, 'rId3', 10, 1);
if (\Inilim\Tool\Method\Other\errorGetLast()) {
    de(\Inilim\Tool\Method\Other\errorGetLast());
}

if ($gen) {

    d($gen['info']);
    $gen = $gen['generator'];

    // $headers = $gen->current();

    // $headers = Arr::mapFilter($headers, static function ($header) {
    //     if (Str::trim($header) === '') {
    //         return null;
    //     }
    //     return true;
    // });
    // $countCols = sizeof($headers);
    // de($countCols);

    $db = __DIR__ . '/test.sqlite';
    if (!\Inilim\Tool\Method\FS\isFile($db)) {
        \Inilim\Tool\Method\File\put($db, '');
        $connect = new IPDOSQLite($db);
        $connect->exec('CREATE TABLE IF NOT EXISTS cols (
            col1 TEXT,
            col2 TEXT,
            col3 TEXT,
            col4 TEXT,
            col5 TEXT,
            col6 TEXT,
            col7 TEXT,
            col8 TEXT,
            col9 TEXT,
            col10 TEXT,
            col11 TEXT,
            col12 TEXT,
            col13 TEXT,
            col14 TEXT,
            col15 TEXT,
            col16 TEXT,
            col17 TEXT,
            col18 TEXT,
            col19 TEXT,
            col20 TEXT,
            col21 TEXT,
            col22 TEXT,
            col23 TEXT,
            col24 TEXT,
            col25 TEXT,
            col26 TEXT,
            col27 TEXT,
            col28 TEXT,
            col29 TEXT,
            col30 TEXT,
            col31 TEXT,
            col32 TEXT,
            col33 TEXT,
            col34 TEXT
        )');
    }
    $connect ??= new IPDOSQLite($db);

    foreach ($gen as $line => $data) {
        //
        // $row = \array_slice($row, 0, 34);
        de($data);
    }
}

de(\Inilim\Tool\Method\Other\errorGetLast());
