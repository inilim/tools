<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class chopEndTest extends TestCase
{
    function test()
    {
        foreach (
            [
                ['path/to/file.php', '.php', 'path/to/file'],
                ['.php-.php', '.php', '.php-'],
                ['path/to/file.php', '.ph', 'path/to/file.php'],
                ['path/to/file.php', 'foo.php', 'path/to/file.php'],
                ['path/to/file.php', '.php-', 'path/to/file.php'],
                ['path/to/file.php', ['.html', '.php'], 'path/to/file'],
                ['path/to/file.php', ['.php', 'file'], 'path/to/file'],
                ['path/to/php.php', '.php', 'path/to/php'],
                ['✋🌊', '🌊', '✋'],
                ['✋🌊', '✋', '✋🌊'],
            ] as $value
        ) {
            [$subject, $needle, $expected] = $value;

            $this->assertSame($expected, Str::chopEnd($subject, $needle));
        }
    }
}
