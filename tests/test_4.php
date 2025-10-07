<?php

declare(strict_types=1);

use Inilim\Tool\Other;

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

\ini_set('memory_limit', '5M');


__includeDeep([
    // 'Other\phpInfoCache',
    // 'Other\phpInfo',
]);

// \Inilim\Tool\Method\Other\phpInfoCache();

$a = \Closure::fromCallable([Other::class, 'timedMsCall']);
$ref = new \ReflectionFunction($a);
dde($ref);
dde($ref->getClosureScopeClass());
