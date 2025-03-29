<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class deduplicateTest extends TestCase
{
    function test()
    {
        $this->assertSame(' explosion php tools ', Str::deduplicate(' explosion   php  tools '));
        $this->assertSame('what', Str::deduplicate('whaaat', 'a'));
        $this->assertSame('/some/odd/path/', Str::deduplicate('/some//odd//path/', '/'));
        $this->assertSame('ムだム', Str::deduplicate('ムだだム', 'だ'));
    }
}
