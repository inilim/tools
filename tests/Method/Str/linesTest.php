<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class linesTest extends TestCase
{
    public string $file1 = __DIR__ . '/../../files/txt/lines.txt';

    function test()
    {
        $content = \file_get_contents($this->file1);
        $lines = \iterator_to_array(Str::lines($content, 0), true);
        $this->assertSame(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'], $lines);

        // offset
        $lines = \iterator_to_array(Str::lines($content, 5), true);
        $this->assertSame([5 => '6', 6 => '7', 7 => '8', 8 =>  '9', 9 => '10'], $lines);
    }
}
