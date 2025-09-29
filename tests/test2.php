<?php

use Inilim\Tool\VD;
use Inilim\Tool\Other;
use Symfony\Component\Process\Process;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

__includeDeep([
    'Exp\excelGetSheetsInfo',
    'Exp\excelReadRowsBySheetId',
    'Other\errorGetLast',
]);


$file = 'C:\Users\work\Desktop\TMEM179B.xlsx';

// $info = \Inilim\Tool\Method\Exp\excelGetSheetsInfo($file);
// if (\Inilim\Tool\Method\Other\errorGetLast()) {
//     de(\Inilim\Tool\Method\Other\errorGetLast());
// }
// de($info);


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
