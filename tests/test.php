<?php

declare(strict_types=1);


require_once \dirname(__DIR__) . '/bootstrap.dev.php';

use Inilim\Tool\Arr;
use Inilim\Tool\Str;
use Inilim\Tool\Xml;
use Inilim\Dump\Dump;
use Inilim\Tool\Data;
use Inilim\Tool\Enum;
use Inilim\Tool\File;
use Inilim\Tool\Json;
use Inilim\Tool\Refl;
use Inilim\Tool\Other;
use Inilim\Tool\Double;
use Inilim\Tool\Integer;
use DragonCode\Benchmark\Benchmark;
use Inilim\Tool\Test\ForTest\ClassicClass;



// $el = Xml::createElFromStr('<field/>');
// $el = Xml::createElFromStr('<field/>');
$el = Xml::createElFromStr('<field/>');

dde($el->ownerDocument->saveHTML($el));
foreach ($el->firstElementChild as $node) {
    de($node);
}

// de($el->nodeType);
// de($el->ownerDocument->saveHTML());
// dde(Xml::toHtml($el->ownerDocument));

de();
$res = Str::_contains('awdwdwdawd', 'w');

dde($res);
de(get_loaded_extensions(true));



de();
__include('Check::php80');
__include('Str::lower');
__include('Str::snake');
__include('Str::kebab');



dde(\Inilim\Tool\Method\Str\kebab('Laravel ❤ Php Framework'));

de();

$multilineValue = <<<'VALUE'
        <?php

        namespace Illuminate\Tests\Support;

        use Exception;
        VALUE;
dde($multilineValue);

// de(get_included_files());
// __include('Str::ltrim');
// $a = Str::excerpt('This is a beautiful morning', 'beautiful', ['radius' => 5]);
// Str::excerpt('This is a beautiful morning', 'beautiful', ['radius' => 5]);
// Str::excerpt('This is a beautiful morning', 'this', ['radius' => 5]);
// Str::excerpt('This is a beautiful morning', 'morning', ['radius' => 5]);
// Str::excerpt('This is a beautiful morning', 'day');
// Str::excerpt('This is a beautiful! morning', 'Beautiful', ['radius' => 5]);
// Str::excerpt('This is a beautiful? morning', 'beautiful', ['radius' => 5]);
// Str::excerpt('', '', ['radius' => 0]);
// Str::excerpt('a', 'a', ['radius' => 0]);
// Str::excerpt('abc', 'B', ['radius' => 0]);
// Str::excerpt('abc', 'b', ['radius' => 1]);
// Str::excerpt('abcd', 'b', ['radius' => 1]);
// Str::excerpt('zabc', 'b', ['radius' => 1]);
// Str::excerpt('zabcd', 'b', ['radius' => 1]);
// Str::excerpt('zabcd', 'b', ['radius' => 2]);
// Str::excerpt('  zabcd  ', 'b', ['radius' => 4]);
// Str::excerpt('z  abc  d', 'b', ['radius' => 1]);
// Str::excerpt('This is a beautiful morning', 'beautiful', ['omission' => '[...]', 'radius' => 5]);
// Str::excerpt(
//     'This is the ultimate supercalifragilisticexpialidocious very looooooooooooooooooong looooooooooooong beautiful morning with amazing sunshine and awesome temperatures. So what are you gonna do about it?',
//     'very',
//     ['omission' => '[...]'],
// );

dde();
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
