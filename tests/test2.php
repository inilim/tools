<?php

declare(strict_types=1);

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

use Inilim\Tool\FS;
use Inilim\Tool\File;
use Inilim\Tool\Path;
use Inilim\Tool\Other;
use Inilim\Tool\Test\ForTest\ClassicClass;


// de(get_defined_constants(true)['Core']);
// de(\array_keys(get_defined_vars()));
__include('Exp::getSuggestionLevenshtein');

$part = ['follo', 'hallo', 'gello', 'bar', 'baz', 'oof'];
$res = \Inilim\Tool\Method\Exp\getSuggestionLevenshtein($part, 'hello');


deUsage($res);
