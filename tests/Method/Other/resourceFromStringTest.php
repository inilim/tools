<?php

namespace Inilim\Tool\Test\Method\Other;

use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class resourceFromStringTest extends TestCase
{
    function test()
    {
        $resource = Other::resourceFromString('Привет');
        $this->assertSame('php://temp', \stream_get_meta_data($resource)['uri']);
        $this->assertSame('Привет', \stream_get_contents($resource));
        \fseek($resource, 0, \SEEK_END);
        \fwrite($resource, '!!!');
        \fseek($resource, 0);
        $this->assertSame('Привет!!!', \stream_get_contents($resource));

        // ---------------------------------------------
        // empty
        // ---------------------------------------------

        $resource = Other::resourceFromString('');
        $this->assertSame('php://temp', \stream_get_meta_data($resource)['uri']);
        $this->assertSame('', \stream_get_contents($resource));
        \fseek($resource, 0, \SEEK_END);
        \fwrite($resource, '!!!');
        \fseek($resource, 0);
        $this->assertSame('!!!', \stream_get_contents($resource));
    }
}
