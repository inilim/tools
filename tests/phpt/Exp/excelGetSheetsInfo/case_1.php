<?php

use Inilim\Tool\Exp;

$file = \test_get_param_from_env('file');

\assertSame(true, \is_string($file));

$results = Exp::excelGetSheetsInfo($file);

\assertSame(true, \is_array($results));
