<?php

namespace Inilim\Tool\Test\Method\Other;

use Inilim\Tool\Other;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class resourceFromString_m2Test extends TestCase
{
    function test()
    {
        $resource = Other::resourceFromString_m2('Привет');
        $ptf = \stream_get_meta_data($resource)['uri'];
        $this->assertTrue(\is_file($ptf));
        \clearstatcache(false, $ptf);
        $this->assertSame('Привет', \stream_get_contents($resource));
        \fseek($resource, 0, \SEEK_END);
        \fwrite($resource, '!!!');
        \fseek($resource, 0);
        $this->assertSame('Привет!!!', \stream_get_contents($resource));
        \fclose($resource);
        $this->assertFalse(\is_file($ptf));

        // ---------------------------------------------
        // empty
        // ---------------------------------------------

        $resource = Other::resourceFromString_m2('');
        $ptf = \stream_get_meta_data($resource)['uri'];
        $this->assertTrue(\is_file($ptf));
        \clearstatcache(false, $ptf);
        $this->assertSame('', \stream_get_contents($resource));
        \fseek($resource, 0, \SEEK_END);
        \fwrite($resource, '!!!');
        \fseek($resource, 0);
        $this->assertSame('!!!', \stream_get_contents($resource));
        \fclose($resource);
        $this->assertFalse(\is_file($ptf));
    }
}
