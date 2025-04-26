<?php

namespace Inilim\Tool\Test\Method\PF;

use Inilim\Tool\PF;
use PHPUnit\Framework\Attributes\DataProvider;

/**
 */
class get_debug_typeTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * @covers \Symfony\Polyfill\Php80\Php80::get_debug_type
     */
    function test()
    {
        $this->assertSame(__CLASS__, PF::get_debug_type($this));
        $this->assertSame('stdClass', PF::get_debug_type(new \stdClass()));
        $this->assertSame('class@anonymous', PF::get_debug_type(eval('return new class() {};')));
        $this->assertSame('stdClass@anonymous', PF::get_debug_type(eval('return new class() extends stdClass {};')));
        $this->assertSame('Reflector@anonymous', PF::get_debug_type(eval('return new class() implements Reflector { function __toString() {} public static function export() {} };')));

        $this->assertSame('string', PF::get_debug_type('foo'));
        $this->assertSame('bool', PF::get_debug_type(false));
        $this->assertSame('bool', PF::get_debug_type(true));
        $this->assertSame('null', PF::get_debug_type(null));
        $this->assertSame('array', PF::get_debug_type([]));
        $this->assertSame('int', PF::get_debug_type(1));
        $this->assertSame('float', PF::get_debug_type(1.2));
        $this->assertSame('resource (stream)', PF::get_debug_type($h = fopen(__FILE__, 'r')));
        $this->assertSame('resource (closed)', PF::get_debug_type(fclose($h) ? $h : $h));

        $unserializeCallbackHandler = ini_set('unserialize_callback_func', null);
        $var = unserialize('O:8:"Foo\Buzz":0:{}');
        ini_set('unserialize_callback_func', $unserializeCallbackHandler);

        $this->assertSame('__PHP_Incomplete_Class', PF::get_debug_type($var));
    }
}
