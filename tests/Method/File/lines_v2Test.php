<?php

namespace Inilim\Tool\Test\Method\File;

use Inilim\Tool\File;
use Inilim\Tool\Test\TestCase;

class lines_v2Test extends TestCase
{
    public string $file1 = __DIR__ . '/../../files/txt/lines.txt';

    function test()
    {
        $lines = \iterator_to_array(File::lines_v2($this->file1, 0), true);
        $this->assertSame(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'], $lines);

        // offset
        $lines = \iterator_to_array(File::lines_v2($this->file1, 5), true);
        $this->assertSame([5 => '6', 6 => '7', 7 => '8', 8 =>  '9', 9 => '10'], $lines);
    }
}
