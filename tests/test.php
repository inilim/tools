<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

use Inilim\Tool\Arr;
use Inilim\Tool\Str;
use Inilim\Dump\Dump;
use Inilim\Tool\Data;
use Inilim\Tool\File;
use Inilim\Tool\Enum;
use Inilim\Tool\Json;
use Inilim\Tool\Refl;
use Inilim\Tool\Other;
use Inilim\Tool\Double;
use Inilim\Tool\Integer;
use DragonCode\Benchmark\Benchmark;
use Inilim\Tool\Test\ForTest\ClassicClass;


// de(get_included_files());
// __include('Exp::hashFile');
class C
{
    public function aaa($name)
    {
        echo 'Привет ', $name, "\n";
    }
}

$c = new C();

dde(is_callable([$c, 'aaa']));

de($a);


// $a = \md5_file('D:\projects\txt_to_sqlite\domains.sqlite');
// $a = \filesize('D:\projects\txt_to_sqlite\domains.sqlite');
// de($a);

// $a = hashFile('md5', 'D:\projects\tools\tests\bench.txt');
// $a = \Inilim\Tool\Method\Exp\hashFile('sha1', 'D:\projects\txt_to_sqlite\domains.sqlite');

$a = sha1_file('D:\projects\tools\tests\bench.txt');
$b = sha1(file_get_contents('D:\projects\tools\tests\bench.txt'));


de($a, $b);


__include('Other::backtrace');

class Staticc
{
    static $aaa = 123;
    static $bbb = 'aaa';
    static $ccc;

    static  function dawd()
    {
        $props = \Inilim\Tool\Method\Other\backtrace();
        dde($props);
    }

    static function wadwdw()
    {
        self::dawd();
    }
}


Staticc::wadwdw();


de();
