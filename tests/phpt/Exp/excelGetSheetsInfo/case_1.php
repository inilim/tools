<?php

use Inilim\Tool\Exp;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @fn=fn_dir_files
 * @arg=xlsx
 * @arg=xls
 */

sleep(10);

exit;
$file = \getopt('', ['file:'])['file'];
$results = Exp::excelGetSheetsInfo($file);

echo \json_encode($results);
