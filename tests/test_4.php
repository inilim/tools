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


$a = new DefinePhpBin;
$a->definePhpBin();
de($a->getPhpBin());
