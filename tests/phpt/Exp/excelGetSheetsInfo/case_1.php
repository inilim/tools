<?php

use Inilim\Tool\Exp;


require_once __DIR__ . '/../../bootstrap.php';

/**
 * @data=data_dir_files
 * @arg[]=xlsx
 * @arg[]=xls
 */

$file = \test_get_cli_arg('file');

$results = Exp::excelGetSheetsInfo($file);

echo \json_encode($results);
