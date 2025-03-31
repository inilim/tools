<?php

declare(strict_types=1);

use Inilim\Tool\Other;
use Inilim\Tool\Test\ForTest\ClassicClass;

require_once __DIR__ . '/bootstrap.php';


// de(get_defined_constants(true)['Core']);
// de(\array_keys(get_defined_vars()));
__include('Exp::getSuggestionLevenshtein');

$part = ['follo', 'hallo', 'gello', 'bar', 'baz', 'oof'];
$res = \Inilim\Tool\Method\Exp\getSuggestionLevenshtein($part, 'hello');


deUsage($res);
