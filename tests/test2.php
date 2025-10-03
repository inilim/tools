<?php

use Inilim\Tool\VD;
use Inilim\Tool\Other;
use Symfony\Component\Process\Process;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

\ini_set('memory_limit', '5M');

__includeDeep([
    'Exp\excelGetSheetsInfo',
    'Exp\excelReadRowsBySheetId',
    'Other\errorGetLast',
    'Other\sqliteLibVersion',
]);


$res = \Inilim\Tool\Method\Other\sqliteLibVersion();
de($res);

// $file = 'C:\Users\work\Desktop\TMEM179B.xlsx';
// $file = 'D:\other\OSPanel\temp\PHP-7.4\default\inilim-tools-excel-98babcf634f61287be6bec391e2ac257-f591fb5a119c29aece10d2e375e4855c.tmp';
// $file = 'D:\projects\tools\tests\big_txt.sqlite';
$file = 'C:\Users\work\Desktop\Отчёт о партнёрах_РЭЧ_2025_РФ.xlsx';

// $info = \Inilim\Tool\Method\Exp\excelGetSheetsInfo($file);
// if (\Inilim\Tool\Method\Other\errorGetLast()) {
//     de(\Inilim\Tool\Method\Other\errorGetLast());
// }
// de($info);


$resourceSheet = \Inilim\Tool\Method\Exp\excelGetResourceSheetById($file, 'rId13');
if ($resourceSheet === null) {
    de(123123);
}

$tmp = \tmpfile();

// $resource = \fopen(\sprintf('expect://sqlite3 "%s"', $file), "r+");


// \stream_copy_to_stream($resourceSheet, $tmp, 1000);
// $output = \fread($tmp, 1000);
// dde($output);
// de($output);

$xml = new \XMLReader;
$xml->open('php://fd/' . \get_resource_id($tmp));
while ($xml->read()) {
    // if ($xml->nodeType === \XMLReader::ELEMENT && $xml->name === 'si') {
    if ($xml->nodeType === \XMLReader::ELEMENT && $xml->name === 'c') {
        dde($xml->readOuterXml());
    }
}

\fclose($tmp);



de();
$result = \Inilim\Tool\Method\Exp\excelReadRowsBySheetId($file, 'rId5', 10000);
if (\Inilim\Tool\Method\Other\errorGetLast()) {
    de(\Inilim\Tool\Method\Other\errorGetLast());
}

foreach ($result as $row) {
    if (\Inilim\Tool\Method\Other\errorGetLast()) {
        de(\Inilim\Tool\Method\Other\errorGetLast());
    }
    // d($row['xml']);
}
// de();
$remove = \Inilim\Tool\Method\Exp\excelRemoveTmpFiles($file);

de($remove);
