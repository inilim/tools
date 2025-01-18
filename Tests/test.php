<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Inilim\Tool\Arr;
use Inilim\Tool\Str;
use Inilim\Dump\Dump;
use Inilim\Tool\Data;
use Inilim\Tool\Json;
use Inilim\Tool\Other;
use Inilim\Tool\Double;
use Inilim\Tool\Integer;
use PhpParser\NodeFinder;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\PrettyPrinter\Standard;

Dump::init();
