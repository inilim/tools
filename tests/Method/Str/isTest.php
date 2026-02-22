<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;
use Inilim\Tool\Test\TestCase;

class isTest extends TestCase
{
    public function testIs()
    {
        $this->assertTrue(Str::is('/', '/'));
        $this->assertFalse(Str::is('/', ' /'));
        $this->assertFalse(Str::is('/', '/a'));
        $this->assertTrue(Str::is('foo/*', 'foo/bar/baz'));

        $this->assertTrue(Str::is('*@*', 'App\Class@method'));
        $this->assertTrue(Str::is('*@*', 'app\Class@'));
        $this->assertTrue(Str::is('*@*', '@method'));

        // is case sensitive
        $this->assertFalse(Str::is('*BAZ*', 'foo/bar/baz'));
        $this->assertFalse(Str::is('*FOO*', 'foo/bar/baz'));
        $this->assertFalse(Str::is('A', 'a'));

        // is not case sensitive
        $this->assertTrue(Str::is('A', 'a', true));
        $this->assertTrue(Str::is('*BAZ*', 'foo/bar/baz', true));
        $this->assertTrue(Str::is(['A*', 'B*'], 'a/', true));
        $this->assertFalse(Str::is(['A*', 'B*'], 'f/', true));
        $this->assertTrue(Str::is('FOO', 'foo', true));
        $this->assertTrue(Str::is('*FOO*', 'foo/bar/baz', true));
        $this->assertTrue(Str::is('foo/*', 'FOO/bar', true));

        // Accepts array of patterns
        $this->assertTrue(Str::is(['a*', 'b*'], 'a/'));
        $this->assertTrue(Str::is(['a*', 'b*'], 'b/'));
        $this->assertFalse(Str::is(['a*', 'b*'], 'f/'));

        // numeric values and patterns
        $this->assertFalse(Str::is(['a*', 'b*'], 123));
        $this->assertTrue(Str::is(['*2*', 'b*'], 11211));

        $this->assertTrue(Str::is('*/foo', 'blah/baz/foo'));

        $valueObject = new StringableObjectStub('foo/bar/baz');
        $patternObject = new StringableObjectStub('foo/*');

        $this->assertTrue(Str::is('foo/bar/baz', $valueObject));
        $this->assertTrue(Str::is($patternObject, $valueObject));

        // empty patterns
        $this->assertFalse(Str::is([], 'test'));

        $this->assertFalse(Str::is('', 0));
        $this->assertFalse(Str::is([null], 0));
        // $this->assertTrue(Str::is([null], null));
    }

    public function testIsWithMultilineStrings()
    {
        $this->assertFalse(Str::is('/', "/\n"));
        $this->assertTrue(Str::is('/*', "/\n"));
        $this->assertTrue(Str::is('*/*', "/\n"));
        $this->assertTrue(Str::is('*/*', "\n/\n"));

        $this->assertTrue(Str::is('*', "\n"));
        $this->assertTrue(Str::is('*', "\n\n"));
        $this->assertFalse(Str::is('', "\n"));
        $this->assertFalse(Str::is('', "\n\n"));

        $multilineValue = <<<'VALUE'
        <?php

        namespace Illuminate\Tests\Support;

        use Exception;
VALUE;

        $this->assertTrue(Str::is($multilineValue, $multilineValue));
        $this->assertTrue(Str::is('*', $multilineValue));
        $this->assertTrue(Str::is("*namespace Illuminate\Tests\*", $multilineValue));
        $this->assertFalse(Str::is("namespace Illuminate\Tests\*", $multilineValue));
        $this->assertFalse(Str::is("*namespace Illuminate\Tests", $multilineValue));
        $this->assertTrue(Str::is('<?php*', $multilineValue));
        $this->assertTrue(Str::is("<?php*namespace Illuminate\Tests\*", $multilineValue));
        $this->assertFalse(Str::is('use Exception;', $multilineValue));
        $this->assertFalse(Str::is('use Exception;*', $multilineValue));
        $this->assertTrue(Str::is('*use Exception;', $multilineValue));
        // INFO в windows PHP_EOL не равняется "\n"
        // $this->assertTrue(Str::is("<?php\n\nnamespace Illuminate\Tests\*", $multilineValue));
        $this->assertTrue(Str::is(\sprintf('<?php%s%snamespace Illuminate\Tests\*', PHP_EOL, PHP_EOL), $multilineValue));

        $this->assertTrue(Str::is(<<<'PATTERN'
        <?php
        *
        namespace Illuminate\Tests\*
PATTERN, $multilineValue));

        $this->assertTrue(Str::is(<<<'PATTERN'
        <?php

        namespace Illuminate\Tests\*
PATTERN, $multilineValue));
    }
}

class StringableObjectStub
{
    private $value;

    function __construct($value)
    {
        $this->value = $value;
    }

    function __toString()
    {
        return $this->value;
    }
}
