<?php

declare(strict_types=1);

require_once \dirname(__DIR__) . '/bootstrap.dev.php';

use Inilim\Tool\VD;
use Inilim\Tool\Arr;
use Inilim\Tool\Obj;
use Inilim\Tool\Str;
use Inilim\Tool\Xml;
use Inilim\Tool\Zip;
use Inilim\Dump\Dump;
use Inilim\Tool\Data;
use Inilim\Tool\Enum;
use Inilim\Tool\File;
use Inilim\Tool\Json;
use Inilim\Tool\Path;
use Inilim\Tool\Refl;
use Inilim\Tool\Time;
use Inilim\Tool\Other;
use Inilim\Tool\Double;
use Inilim\Tool\Integer;
use Composer\InstalledVersions;
use DragonCode\Benchmark\Benchmark;
use Inilim\Tool\Test\ForTest\ClassicClass;
use Inilim\Tool\Test\ForTest\ClassArrayAccessIteratorAggregate;

$file = 'C:\Users\work\Desktop\excel.xlsx';

$zip = Zip::open($file);
$workbook = $zip->locateName('workbook.xml', \ZipArchive::FL_NODIR | \ZipArchive::FL_NOCASE);
$resource = $zip->getStreamIndex($workbook, \ZipArchive::FL_UNCHANGED);
dde(Other::resourceToTmpFile($resource));




de();
