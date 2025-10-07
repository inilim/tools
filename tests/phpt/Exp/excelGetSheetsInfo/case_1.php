<?php

use Inilim\Tool\Exp;


require_once __DIR__ . '/../../bootstrap.php';


$file = \test_get_cli_arg('file');

$results = Exp::excelGetSheetsInfo($file);

echo \json_encode($results);
