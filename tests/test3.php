<?php

declare(strict_types=1);

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

$xml = 'D:\projects\tools\files\tests\xml\big.xml';

dUsage();
$doc = new \DOMDocument;
$doc->load($xml);

$x = new \DOMXPath($doc);

$x->registerPhpFunctions()

d($doc->xmlVersion);
// d($doc->getElementsByTagName());
dUsage();
