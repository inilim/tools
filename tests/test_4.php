<?php

declare(strict_types=1);

use Inilim\Tool\Other;
use Inilim\Tool\Test\DefinePhpBin;


require_once \dirname(__DIR__) . '/bootstrap.dev.php';

\ini_set('memory_limit', '5M');

__includeDeep([
    // 'Other\phpInfoCache',
    // 'Other\phpInfo',
]);


// de(ini_get_all());
de([
    'php_ini_loaded_file'   => \php_ini_loaded_file(),
    'php_ini_scanned_files' => \php_ini_scanned_files(),
    'get_loaded_extensions' => \get_loaded_extensions(),
    // 'ini_get_all' => \ini_get_all(),
    'cli_get_process_title' => \cli_get_process_title(),
]);

de();
$a = new DefinePhpBin;
$a->definePhpBin();
de($a->getPhpBin());
