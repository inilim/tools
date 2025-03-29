<?php

namespace Illuminate\Tests\Support;

use Exception;
use ValueError;
use Inilim\Tool\Str;
use ReflectionClass;
use Ramsey\Uuid\UuidInterface;
use PHPUnit\Framework\Attributes\DataProvider;

class SupportStrTest extends \Inilim\Tool\Test\TestCase
{
    function testParseCallback()
    {
        $this->assertEquals(['Class', 'method'], Str::parseCallback('Class@method'));
        $this->assertEquals(['Class', 'method'], Str::parseCallback('Class@method', 'foo'));
        $this->assertEquals(['Class', 'foo'], Str::parseCallback('Class', 'foo'));
        $this->assertEquals(['Class', null], Str::parseCallback('Class'));

        $this->assertEquals(["Class@anonymous\0/explosion/382.php:8$2ec", 'method'], Str::parseCallback("Class@anonymous\0/explosion/382.php:8$2ec@method"));
        $this->assertEquals(["Class@anonymous\0/explosion/382.php:8$2ec", 'method'], Str::parseCallback("Class@anonymous\0/explosion/382.php:8$2ec@method", 'foo'));
        $this->assertEquals(["Class@anonymous\0/explosion/382.php:8$2ec", 'foo'], Str::parseCallback("Class@anonymous\0/explosion/382.php:8$2ec", 'foo'));
        $this->assertEquals(["Class@anonymous\0/explosion/382.php:8$2ec", null], Str::parseCallback("Class@anonymous\0/explosion/382.php:8$2ec"));
    }

    function testSlug()
    {
        $this->assertSame('hello-world', Str::slug('hello world'));
        $this->assertSame('hello-world', Str::slug('hello-world'));
        $this->assertSame('hello-world', Str::slug('hello_world'));
        $this->assertSame('hello_world', Str::slug('hello_world', '_'));
        $this->assertSame('user-at-host', Str::slug('user@host'));
        $this->assertSame('سلام-دنیا', Str::slug('سلام دنیا', '-', null));
        $this->assertSame('sometext', Str::slug('some text', ''));
        $this->assertSame('', Str::slug('', ''));
        $this->assertSame('', Str::slug(''));
        $this->assertSame('bsm-allah', Str::slug('بسم الله', '-', 'en', ['allh' => 'allah']));
        $this->assertSame('500-dollar-bill', Str::slug('500$ bill', '-', 'en', ['$' => 'dollar']));
        $this->assertSame('500-dollar-bill', Str::slug('500--$----bill', '-', 'en', ['$' => 'dollar']));
        $this->assertSame('500-dollar-bill', Str::slug('500-$-bill', '-', 'en', ['$' => 'dollar']));
        $this->assertSame('500-dollar-bill', Str::slug('500$--bill', '-', 'en', ['$' => 'dollar']));
        $this->assertSame('500-dollar-bill', Str::slug('500-$--bill', '-', 'en', ['$' => 'dollar']));
        $this->assertSame('أحمد-في-المدرسة', Str::slug('أحمد@المدرسة', '-', null, ['@' => 'في']));
    }

    function testStrStart()
    {
        $this->assertSame('/test/string', Str::start('test/string', '/'));
        $this->assertSame('/test/string', Str::start('/test/string', '/'));
        $this->assertSame('/test/string', Str::start('//test/string', '/'));
    }

    function testFlushCache()
    {
        $reflection = new ReflectionClass(Str::class);
        $property = $reflection->getProperty('snakeCache');

        Str::flushCache();
        $this->assertEmpty($property->getValue());

        Str::snake('Hello World');
        $this->assertNotEmpty($property->getValue());

        Str::flushCache();
        $this->assertEmpty($property->getValue());
    }

    function testFinish()
    {
        $this->assertSame('abbc', Str::finish('ab', 'bc'));
        $this->assertSame('abbc', Str::finish('abbcbc', 'bc'));
        $this->assertSame('abcbbc', Str::finish('abcbbcbc', 'bc'));
    }

    function testWrap()
    {
        $this->assertEquals('"value"', Str::wrap('value', '"'));
        $this->assertEquals('foo-bar-baz', Str::wrap('-bar-', 'foo', 'baz'));
    }

    function testUnwrap()
    {
        $this->assertEquals('value', Str::unwrap('"value"', '"'));
        $this->assertEquals('value', Str::unwrap('"value', '"'));
        $this->assertEquals('value', Str::unwrap('value"', '"'));
        $this->assertEquals('bar', Str::unwrap('foo-bar-baz', 'foo-', '-baz'));
        $this->assertEquals('some: "json"', Str::unwrap('{some: "json"}', '{', '}'));
    }

    function testIs()
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
        $this->assertTrue(Str::is([null], null));
    }

    function testIsWithMultilineStrings()
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

        $this->assertTrue(Str::is("<?php\n\nnamespace Illuminate\Tests\*", $multilineValue));

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

    function testIsUrl()
    {
        $this->assertTrue(Str::isUrl('https://explosion.com'));
        $this->assertTrue(Str::isUrl('http://localhost'));
        $this->assertFalse(Str::isUrl('invalid url'));
    }

    #[DataProvider('validUuidList')]
    function testIsUuidWithValidUuid($uuid)
    {
        $this->assertTrue(Str::isUuid($uuid));
    }

    #[DataProvider('invalidUuidList')]
    function testIsUuidWithInvalidUuid($uuid)
    {
        $this->assertFalse(Str::isUuid($uuid));
    }

    #[DataProvider('uuidVersionList')]
    function testIsUuidWithVersion($uuid, $version, $passes)
    {
        $this->assertSame(Str::isUuid($uuid, $version), $passes);
    }

    function testIsJson()
    {
        $this->assertTrue(Str::isJson('1'));
        $this->assertTrue(Str::isJson('[1,2,3]'));
        $this->assertTrue(Str::isJson('[1,   2,   3]'));
        $this->assertTrue(Str::isJson('{"first": "John", "last": "Doe"}'));
        $this->assertTrue(Str::isJson('[{"first": "John", "last": "Doe"}, {"first": "Jane", "last": "Doe"}]'));

        $this->assertFalse(Str::isJson('1,'));
        $this->assertFalse(Str::isJson('[1,2,3'));
        $this->assertFalse(Str::isJson('[1,   2   3]'));
        $this->assertFalse(Str::isJson('{first: "John"}'));
        $this->assertFalse(Str::isJson('[{first: "John"}, {first: "Jane"}]'));
        $this->assertFalse(Str::isJson(''));
        $this->assertFalse(Str::isJson(null));
        $this->assertFalse(Str::isJson([]));
    }

    function testIsMatch()
    {
        $this->assertTrue(Str::isMatch('/.*,.*!/', 'Hello, Explosion!'));
        $this->assertTrue(Str::isMatch('/^.*$(.*)/', 'Hello, Explosion!'));
        $this->assertTrue(Str::isMatch('/explosion/i', 'Hello, Explosion!'));
        $this->assertTrue(Str::isMatch('/^(.*(.*(.*)))/', 'Hello, Explosion!'));

        $this->assertFalse(Str::isMatch('/H.o/', 'Hello, Explosion!'));
        $this->assertFalse(Str::isMatch('/^explosion!/i', 'Hello, Explosion!'));
        $this->assertFalse(Str::isMatch('/explosion!(.*)/', 'Hello, Explosion!'));
        $this->assertFalse(Str::isMatch('/^[a-zA-Z,!]+$/', 'Hello, Explosion!'));

        $this->assertTrue(Str::isMatch(['/.*,.*!/', '/H.o/'], 'Hello, Explosion!'));
        $this->assertTrue(Str::isMatch(['/^explosion!/i', '/^.*$(.*)/'], 'Hello, Explosion!'));
        $this->assertTrue(Str::isMatch(['/explosion/i', '/explosion!(.*)/'], 'Hello, Explosion!'));
        $this->assertTrue(Str::isMatch(['/^[a-zA-Z,!]+$/', '/^(.*(.*(.*)))/'], 'Hello, Explosion!'));
    }

    function testKebab()
    {
        $this->assertSame('explosion-php-tools', Str::kebab('ExplosionPhpTools'));
        $this->assertSame('explosion-php-tools', Str::kebab('Explosion Php Tools'));
        $this->assertSame('explosion❤-php-tools', Str::kebab('Explosion ❤ Php Tools'));
        $this->assertSame('', Str::kebab(''));
    }

    function testLower()
    {
        $this->assertSame('foo bar baz', Str::lower('FOO BAR BAZ'));
        $this->assertSame('foo bar baz', Str::lower('fOo Bar bAz'));
    }

    function testUpper()
    {
        $this->assertSame('FOO BAR BAZ', Str::upper('foo bar baz'));
        $this->assertSame('FOO BAR BAZ', Str::upper('foO bAr BaZ'));
    }

    function testLength()
    {
        $this->assertEquals(11, Str::length('foo bar baz'));
        $this->assertEquals(11, Str::length('foo bar baz', 'UTF-8'));
    }

    function testNumbers()
    {
        $this->assertSame('5551234567', Str::numbers('(555) 123-4567'));
        $this->assertSame('443', Str::numbers('L4r4v3l!'));
        $this->assertSame('', Str::numbers('Explosion!'));

        $arrayValue = ['(555) 123-4567', 'L4r4v3l', 'Explosion!'];
        $arrayExpected = ['5551234567', '443', ''];
        $this->assertSame($arrayExpected, Str::numbers($arrayValue));
    }

    function testRandom()
    {
        $this->assertEquals(16, strlen(Str::random()));
        $randomInteger = random_int(1, 100);
        $this->assertEquals($randomInteger, strlen(Str::random($randomInteger)));
        $this->assertIsString(Str::random());
    }

    function testWhetherTheNumberOfGeneratedCharactersIsEquallyDistributed()
    {
        $results = [];
        // take 6.200.000 samples, because there are 62 different characters
        for ($i = 0; $i < 620000; $i++) {
            $random = Str::random(1);
            $results[$random] = ($results[$random] ?? 0) + 1;
        }

        // each character should occur 100.000 times with a variance of 5%.
        foreach ($results as $result) {
            $this->assertEqualsWithDelta(10000, $result, 500);
        }
    }

    function testRandomStringFactoryCanBeSet()
    {
        Str::createRandomStringsUsing(fn($length) => 'length:' . $length);

        $this->assertSame('length:7', Str::random(7));
        $this->assertSame('length:7', Str::random(7));

        Str::createRandomStringsNormally();

        $this->assertNotSame('length:7', Str::random());
    }

    function testItCanSpecifyASequenceOfRandomStringsToUtilise()
    {
        Str::createRandomStringsUsingSequence([
            0 => 'x',
            // 1 => just generate a random one here...
            2 => 'y',
            3 => 'z',
            // ... => continue to generate random strings...
        ]);

        $this->assertSame('x', Str::random());
        $this->assertSame(16, mb_strlen(Str::random()));
        $this->assertSame('y', Str::random());
        $this->assertSame('z', Str::random());
        $this->assertSame(16, mb_strlen(Str::random()));
        $this->assertSame(16, mb_strlen(Str::random()));

        Str::createRandomStringsNormally();
    }

    function testItCanSpecifyAFallbackForARandomStringSequence()
    {
        Str::createRandomStringsUsingSequence([Str::random(), Str::random()], fn() => throw new Exception('Out of random strings.'));
        Str::random();
        Str::random();

        try {
            $this->expectExceptionMessage('Out of random strings.');
            Str::random();
            $this->fail();
        } finally {
            Str::createRandomStringsNormally();
        }
    }

    function testReplace()
    {
        $this->assertSame('foo bar explosion', Str::replace('baz', 'explosion', 'foo bar baz'));
        $this->assertSame('foo bar explosion', Str::replace('baz', 'explosion', 'foo bar Baz', false));
        $this->assertSame('foo bar baz 8.x', Str::replace('?', '8.x', 'foo bar baz ?'));
        $this->assertSame('foo bar baz 8.x', Str::replace('x', '8.x', 'foo bar baz X', false));
        $this->assertSame('foo/bar/baz', Str::replace(' ', '/', 'foo bar baz'));
        $this->assertSame('foo bar baz', Str::replace(['?1', '?2', '?3'], ['foo', 'bar', 'baz'], '?1 ?2 ?3'));
        $this->assertSame(['foo', 'bar', 'baz'], Str::replace(collect(['?1', '?2', '?3']), collect(['foo', 'bar', 'baz']), collect(['?1', '?2', '?3'])));
    }

    function testReplaceArray()
    {
        $this->assertSame('foo/bar/baz', Str::replaceArray('?', ['foo', 'bar', 'baz'], '?/?/?'));
        $this->assertSame('foo/bar/baz/?', Str::replaceArray('?', ['foo', 'bar', 'baz'], '?/?/?/?'));
        $this->assertSame('foo/bar', Str::replaceArray('?', ['foo', 'bar', 'baz'], '?/?'));
        $this->assertSame('?/?/?', Str::replaceArray('x', ['foo', 'bar', 'baz'], '?/?/?'));
        // Ensure recursive replacements are avoided
        $this->assertSame('foo?/bar/baz', Str::replaceArray('?', ['foo?', 'bar', 'baz'], '?/?/?'));
        // Test for associative array support
        $this->assertSame('foo/bar', Str::replaceArray('?', [1 => 'foo', 2 => 'bar'], '?/?'));
        $this->assertSame('foo/bar', Str::replaceArray('?', ['x' => 'foo', 'y' => 'bar'], '?/?'));
        // Test does not crash on bad input
        $this->assertSame('?', Str::replaceArray('?', [(object) ['foo' => 'bar']], '?'));
    }

    function testReplaceFirst()
    {
        $this->assertSame('fooqux foobar', Str::replaceFirst('bar', 'qux', 'foobar foobar'));
        $this->assertSame('foo/qux? foo/bar?', Str::replaceFirst('bar?', 'qux?', 'foo/bar? foo/bar?'));
        $this->assertSame('foo foobar', Str::replaceFirst('bar', '', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceFirst('xxx', 'yyy', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceFirst('', 'yyy', 'foobar foobar'));
        $this->assertSame('1', Str::replaceFirst(0, '1', '0'));
        // Test for multibyte string support
        $this->assertSame('Jxxxnköping Malmö', Str::replaceFirst('ö', 'xxx', 'Jönköping Malmö'));
        $this->assertSame('Jönköping Malmö', Str::replaceFirst('', 'yyy', 'Jönköping Malmö'));
    }

    function testReplaceStart()
    {
        $this->assertSame('foobar foobar', Str::replaceStart('bar', 'qux', 'foobar foobar'));
        $this->assertSame('foo/bar? foo/bar?', Str::replaceStart('bar?', 'qux?', 'foo/bar? foo/bar?'));
        $this->assertSame('quxbar foobar', Str::replaceStart('foo', 'qux', 'foobar foobar'));
        $this->assertSame('qux? foo/bar?', Str::replaceStart('foo/bar?', 'qux?', 'foo/bar? foo/bar?'));
        $this->assertSame('bar foobar', Str::replaceStart('foo', '', 'foobar foobar'));
        $this->assertSame('1', Str::replaceStart(0, '1', '0'));
        // Test for multibyte string support
        $this->assertSame('xxxnköping Malmö', Str::replaceStart('Jö', 'xxx', 'Jönköping Malmö'));
        $this->assertSame('Jönköping Malmö', Str::replaceStart('', 'yyy', 'Jönköping Malmö'));
    }

    function testReplaceLast()
    {
        $this->assertSame('foobar fooqux', Str::replaceLast('bar', 'qux', 'foobar foobar'));
        $this->assertSame('foo/bar? foo/qux?', Str::replaceLast('bar?', 'qux?', 'foo/bar? foo/bar?'));
        $this->assertSame('foobar foo', Str::replaceLast('bar', '', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceLast('xxx', 'yyy', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceLast('', 'yyy', 'foobar foobar'));
        // Test for multibyte string support
        $this->assertSame('Malmö Jönkxxxping', Str::replaceLast('ö', 'xxx', 'Malmö Jönköping'));
        $this->assertSame('Malmö Jönköping', Str::replaceLast('', 'yyy', 'Malmö Jönköping'));
    }

    function testReplaceEnd()
    {
        $this->assertSame('foobar fooqux', Str::replaceEnd('bar', 'qux', 'foobar foobar'));
        $this->assertSame('foo/bar? foo/qux?', Str::replaceEnd('bar?', 'qux?', 'foo/bar? foo/bar?'));
        $this->assertSame('foobar foo', Str::replaceEnd('bar', '', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceEnd('xxx', 'yyy', 'foobar foobar'));
        $this->assertSame('foobar foobar', Str::replaceEnd('', 'yyy', 'foobar foobar'));
        $this->assertSame('fooxxx foobar', Str::replaceEnd('xxx', 'yyy', 'fooxxx foobar'));

        // // Test for multibyte string support
        $this->assertSame('Malmö Jönköping', Str::replaceEnd('ö', 'xxx', 'Malmö Jönköping'));
        $this->assertSame('Malmö Jönkyyy', Str::replaceEnd('öping', 'yyy', 'Malmö Jönköping'));
    }

    function testRemove()
    {
        $this->assertSame('Fbar', Str::remove('o', 'Foobar'));
        $this->assertSame('Foo', Str::remove('bar', 'Foobar'));
        $this->assertSame('oobar', Str::remove('F', 'Foobar'));
        $this->assertSame('Foobar', Str::remove('f', 'Foobar'));
        $this->assertSame('oobar', Str::remove('f', 'Foobar', false));

        $this->assertSame('Fbr', Str::remove(['o', 'a'], 'Foobar'));
        $this->assertSame('Fooar', Str::remove(['f', 'b'], 'Foobar'));
        $this->assertSame('ooar', Str::remove(['f', 'b'], 'Foobar', false));
        $this->assertSame('Foobar', Str::remove(['f', '|'], 'Foo|bar'));
    }

    function testReverse()
    {
        $this->assertSame('FooBar', Str::reverse('raBooF'));
        $this->assertSame('Teniszütő', Str::reverse('őtüzsineT'));
        $this->assertSame('❤MultiByte☆', Str::reverse('☆etyBitluM❤'));
    }

    function testSnake()
    {
        $this->assertSame('explosion_p_h_p_tools', Str::snake('ExplosionPHPTools'));
        $this->assertSame('explosion_php_tools', Str::snake('ExplosionPhpTools'));
        $this->assertSame('explosion php tools', Str::snake('ExplosionPhpTools', ' '));
        $this->assertSame('explosion_php_tools', Str::snake('Explosion Php Tools'));
        $this->assertSame('explosion_php_tools', Str::snake('Explosion    Php      Tools   '));
        // ensure cache keys don't overlap
        $this->assertSame('explosion__php__tools', Str::snake('ExplosionPhpTools', '__'));
        $this->assertSame('explosion_php_tools_', Str::snake('ExplosionPhpTools_', '_'));
        $this->assertSame('explosion_php_tools', Str::snake('explosion php Tools'));
        $this->assertSame('explosion_php_frame_work', Str::snake('explosion php FrameWork'));
        // prevent breaking changes
        $this->assertSame('foo-bar', Str::snake('foo-bar'));
        $this->assertSame('foo-_bar', Str::snake('Foo-Bar'));
        $this->assertSame('foo__bar', Str::snake('Foo_Bar'));
        $this->assertSame('żółtałódka', Str::snake('ŻółtaŁódka'));
    }

    function testTrim()
    {
        $this->assertSame('foo bar', Str::trim('   foo bar   '));
        $this->assertSame('foo bar', Str::trim('foo bar   '));
        $this->assertSame('foo bar', Str::trim('   foo bar'));
        $this->assertSame('foo bar', Str::trim('foo bar'));
        $this->assertSame(' foo bar ', Str::trim(' foo bar ', ''));
        $this->assertSame('foo bar', Str::trim(' foo bar ', ' '));
        $this->assertSame('foo  bar', Str::trim('-foo  bar_', '-_'));

        $this->assertSame('foo    bar', Str::trim(' foo    bar '));

        $this->assertSame('123', Str::trim('   123    '));
        $this->assertSame('だ', Str::trim('だ'));
        $this->assertSame('ム', Str::trim('ム'));
        $this->assertSame('だ', Str::trim('   だ    '));
        $this->assertSame('ム', Str::trim('   ム    '));

        $this->assertSame(
            'foo bar',
            Str::trim('
                foo bar
            ')
        );
        $this->assertSame(
            'foo
                bar',
            Str::trim('
                foo
                bar
            ')
        );

        $this->assertSame("\xE9", Str::trim(" \xE9 "));

        $trimDefaultChars = [' ', "\n", "\r", "\t", "\v", "\0"];

        foreach ($trimDefaultChars as $char) {
            $this->assertSame('', Str::trim(" {$char} "));
            $this->assertSame(trim(" {$char} "), Str::trim(" {$char} "));

            $this->assertSame('foo bar', Str::trim("{$char} foo bar {$char}"));
            $this->assertSame(trim("{$char} foo bar {$char}"), Str::trim("{$char} foo bar {$char}"));
        }
    }

    function testLtrim()
    {
        $this->assertSame('foo    bar ', Str::ltrim(' foo    bar '));

        $this->assertSame('123    ', Str::ltrim('   123    '));
        $this->assertSame('だ', Str::ltrim('だ'));
        $this->assertSame('ム', Str::ltrim('ム'));
        $this->assertSame('だ    ', Str::ltrim('   だ    '));
        $this->assertSame('ム    ', Str::ltrim('   ム    '));

        $this->assertSame(
            'foo bar
            ',
            Str::ltrim('
                foo bar
            ')
        );
        $this->assertSame("\xE9 ", Str::ltrim(" \xE9 "));

        $ltrimDefaultChars = [' ', "\n", "\r", "\t", "\v", "\0"];

        foreach ($ltrimDefaultChars as $char) {
            $this->assertSame('', Str::ltrim(" {$char} "));
            $this->assertSame(ltrim(" {$char} "), Str::ltrim(" {$char} "));

            $this->assertSame("foo bar {$char}", Str::ltrim("{$char} foo bar {$char}"));
            $this->assertSame(ltrim("{$char} foo bar {$char}"), Str::ltrim("{$char} foo bar {$char}"));
        }
    }

    function testRtrim()
    {
        $this->assertSame(' foo    bar', Str::rtrim(' foo    bar '));

        $this->assertSame('   123', Str::rtrim('   123    '));
        $this->assertSame('だ', Str::rtrim('だ'));
        $this->assertSame('ム', Str::rtrim('ム'));
        $this->assertSame('   だ', Str::rtrim('   だ    '));
        $this->assertSame('   ム', Str::rtrim('   ム    '));

        $this->assertSame(
            '
                foo bar',
            Str::rtrim('
                foo bar
            ')
        );

        $this->assertSame(" \xE9", Str::rtrim(" \xE9 "));

        $rtrimDefaultChars = [' ', "\n", "\r", "\t", "\v", "\0"];

        foreach ($rtrimDefaultChars as $char) {
            $this->assertSame('', Str::rtrim(" {$char} "));
            $this->assertSame(rtrim(" {$char} "), Str::rtrim(" {$char} "));

            $this->assertSame("{$char} foo bar", Str::rtrim("{$char} foo bar {$char}"));
            $this->assertSame(rtrim("{$char} foo bar {$char}"), Str::rtrim("{$char} foo bar {$char}"));
        }
    }

    function testSquish()
    {
        $this->assertSame('explosion php tools', Str::squish(' explosion   php  tools '));
        $this->assertSame('explosion php tools', Str::squish("explosion\t\tphp\n\ntools"));
        $this->assertSame('explosion php tools', Str::squish('
            explosion
            php
            tools
        '));
        $this->assertSame('explosion php tools', Str::squish('   explosion   php   tools   '));
        $this->assertSame('123', Str::squish('   123    '));
        $this->assertSame('だ', Str::squish('だ'));
        $this->assertSame('ム', Str::squish('ム'));
        $this->assertSame('だ', Str::squish('   だ    '));
        $this->assertSame('ム', Str::squish('   ム    '));
        $this->assertSame('explosion php tools', Str::squish('explosionㅤㅤㅤphpㅤtools'));
        $this->assertSame('explosion php tools', Str::squish('explosionᅠᅠᅠᅠᅠᅠᅠᅠᅠᅠphpᅠᅠtools'));
    }

    function testStudly()
    {
        $this->assertSame('ExplosionPHPTools', Str::studly('explosion_p_h_p_tools'));
        $this->assertSame('ExplosionPhpTools', Str::studly('explosion_php_tools'));
        $this->assertSame('ExplosionPhPTools', Str::studly('explosion-phP-tools'));
        $this->assertSame('ExplosionPhpTools', Str::studly('explosion  -_-  php   -_-   tools   '));

        $this->assertSame('FooBar', Str::studly('fooBar'));
        $this->assertSame('FooBar', Str::studly('foo_bar'));
        $this->assertSame('FooBar', Str::studly('foo_bar')); // test cache
        $this->assertSame('FooBarBaz', Str::studly('foo-barBaz'));
        $this->assertSame('FooBarBaz', Str::studly('foo-bar_baz'));

        $this->assertSame('ÖffentlicheÜberraschungen', Str::studly('öffentliche-überraschungen'));
    }

    function testPascal()
    {
        $this->assertSame('ExplosionPhpTools', Str::pascal('explosion_php_tools'));
        $this->assertSame('ExplosionPhpTools', Str::pascal('explosion-php-tools'));
        $this->assertSame('ExplosionPhpTools', Str::pascal('explosion  -_-  php   -_-   tools   '));

        $this->assertSame('FooBar', Str::pascal('fooBar'));
        $this->assertSame('FooBar', Str::pascal('foo_bar'));
        $this->assertSame('FooBar', Str::pascal('foo_bar')); // test cache
        $this->assertSame('FooBarBaz', Str::pascal('foo-barBaz'));
        $this->assertSame('FooBarBaz', Str::pascal('foo-bar_baz'));

        $this->assertSame('ÖffentlicheÜberraschungen', Str::pascal('öffentliche-überraschungen'));
    }

    function testMask()
    {
        $this->assertSame('hel*************', Str::mask('hello@email.com', '*', 3));
        $this->assertSame('******@email.com', Str::mask('hello@email.com', '*', 0, 6));
        $this->assertSame('hel*************', Str::mask('hello@email.com', '*', -13));
        $this->assertSame('hel***@email.com', Str::mask('hello@email.com', '*', -13, 3));

        $this->assertSame('****************', Str::mask('hello@email.com', '*', -17));
        $this->assertSame('*****r@email.com', Str::mask('hello@email.com', '*', -99, 5));

        $this->assertSame('hello@email.com', Str::mask('hello@email.com', '*', 16));
        $this->assertSame('hello@email.com', Str::mask('hello@email.com', '*', 16, 99));

        $this->assertSame('hello@email.com', Str::mask('hello@email.com', '', 3));

        $this->assertSame('helsssssssssssss', Str::mask('hello@email.com', 'something', 3));
        $this->assertSame('helsssssssssssss', Str::mask('hello@email.com', Str::of('something'), 3));

        $this->assertSame('这是一***', Str::mask('这是一段中文', '*', 3));
        $this->assertSame('**一段中文', Str::mask('这是一段中文', '*', 0, 2));

        $this->assertSame('ma*n@email.com', Str::mask('maan@email.com', '*', 2, 1));
        $this->assertSame('ma***email.com', Str::mask('maan@email.com', '*', 2, 3));
        $this->assertSame('ma************', Str::mask('maan@email.com', '*', 2));

        $this->assertSame('mari*@email.com', Str::mask('maria@email.com', '*', 4, 1));
        $this->assertSame('tamar*@email.com', Str::mask('tamara@email.com', '*', 5, 1));

        $this->assertSame('*aria@email.com', Str::mask('maria@email.com', '*', 0, 1));
        $this->assertSame('maria@email.co*', Str::mask('maria@email.com', '*', -1, 1));
        $this->assertSame('maria@email.co*', Str::mask('maria@email.com', '*', -1));
        $this->assertSame('***************', Str::mask('maria@email.com', '*', -15));
        $this->assertSame('***************', Str::mask('maria@email.com', '*', 0));
    }

    function testMatch(): void
    {
        $this->assertSame('bar', Str::match('/bar/', 'foo bar'));
        $this->assertSame('bar', Str::match('/foo (.*)/', 'foo bar'));
        $this->assertEmpty(Str::match('/nothing/', 'foo bar'));

        $this->assertEquals(['bar', 'bar'], Str::matchAll('/bar/', 'bar foo bar')->all());

        $this->assertEquals(['un', 'ly'], Str::matchAll('/f(\w*)/', 'bar fun bar fly')->all());
        $this->assertEmpty(Str::matchAll('/nothing/', 'bar fun bar fly'));

        $this->assertEmpty(Str::match('/pattern/', ''));
        $this->assertEmpty(Str::matchAll('/pattern/', ''));
    }

    function testCamel(): void
    {
        $this->assertSame('explosionPHPTools', Str::camel('Explosion_p_h_p_tools'));
        $this->assertSame('explosionPhpTools', Str::camel('Explosion_php_tools'));
        $this->assertSame('explosionPhPTools', Str::camel('Explosion-phP-tools'));
        $this->assertSame('explosionPhpTools', Str::camel('Explosion  -_-  php   -_-   tools   '));

        $this->assertSame('fooBar', Str::camel('FooBar'));
        $this->assertSame('fooBar', Str::camel('foo_bar'));
        $this->assertSame('fooBar', Str::camel('foo_bar')); // test cache
        $this->assertSame('fooBarBaz', Str::camel('Foo-barBaz'));
        $this->assertSame('fooBarBaz', Str::camel('foo-bar_baz'));

        $this->assertSame('', Str::camel(''));
        $this->assertSame('lARAVELPHPFRAMEWORK', Str::camel('LARAVEL_PHP_FRAMEWORK'));
        $this->assertSame('explosionPhpTools', Str::camel('   explosion   php   tools   '));

        $this->assertSame('foo1Bar', Str::camel('foo1_bar'));
        $this->assertSame('1FooBar', Str::camel('1 foo bar'));
    }

    function testCharAt()
    {
        $this->assertEquals('р', Str::charAt('Привет, мир!', 1));
        $this->assertEquals('ち', Str::charAt('「こんにちは世界」', 4));
        $this->assertEquals('w', Str::charAt('Привет, world!', 8));
        $this->assertEquals('界', Str::charAt('「こんにちは世界」', -2));
        $this->assertEquals(null, Str::charAt('「こんにちは世界」', -200));
        $this->assertEquals(null, Str::charAt('Привет, мир!', 100));
    }

    function testSubstr()
    {
        $this->assertSame('Ё', Str::substr('БГДЖИЛЁ', -1));
        $this->assertSame('ЛЁ', Str::substr('БГДЖИЛЁ', -2));
        $this->assertSame('И', Str::substr('БГДЖИЛЁ', -3, 1));
        $this->assertSame('ДЖИЛ', Str::substr('БГДЖИЛЁ', 2, -1));
        $this->assertEmpty(Str::substr('БГДЖИЛЁ', 4, -4));
        $this->assertSame('ИЛ', Str::substr('БГДЖИЛЁ', -3, -1));
        $this->assertSame('ГДЖИЛЁ', Str::substr('БГДЖИЛЁ', 1));
        $this->assertSame('ГДЖ', Str::substr('БГДЖИЛЁ', 1, 3));
        $this->assertSame('БГДЖ', Str::substr('БГДЖИЛЁ', 0, 4));
        $this->assertSame('Ё', Str::substr('БГДЖИЛЁ', -1, 1));
        $this->assertEmpty(Str::substr('Б', 2));
    }

    function testSubstrCount()
    {
        $this->assertSame(3, Str::substrCount('explosionPHPTools', 'a'));
        $this->assertSame(0, Str::substrCount('explosionPHPTools', 'z'));
        $this->assertSame(1, Str::substrCount('explosionPHPTools', 'l', 2));
        $this->assertSame(0, Str::substrCount('explosionPHPTools', 'z', 2));
        $this->assertSame(1, Str::substrCount('explosionPHPTools', 'k', -1));
        $this->assertSame(1, Str::substrCount('explosionPHPTools', 'k', -1));
        $this->assertSame(1, Str::substrCount('explosionPHPTools', 'a', 1, 2));
        $this->assertSame(1, Str::substrCount('explosionPHPTools', 'a', 1, 2));
        $this->assertSame(3, Str::substrCount('explosionPHPTools', 'a', 1, -2));
        $this->assertSame(1, Str::substrCount('explosionPHPTools', 'a', -10, -3));
    }

    function testPosition()
    {
        $this->assertSame(7, Str::position('Hello, World!', 'W'));
        $this->assertSame(10, Str::position('This is a test string.', 'test'));
        $this->assertSame(23, Str::position('This is a test string, test again.', 'test', 15));
        $this->assertSame(0, Str::position('Hello, World!', 'Hello'));
        $this->assertSame(7, Str::position('Hello, World!', 'World!'));
        $this->assertSame(10, Str::position('This is a tEsT string.', 'tEsT', 0, 'UTF-8'));
        $this->assertSame(7, Str::position('Hello, World!', 'W', -6));
        $this->assertSame(18, Str::position('Äpfel, Birnen und Kirschen', 'Kirschen', -10, 'UTF-8'));
        $this->assertSame(9, Str::position('@%€/=!"][$', '$', 0, 'UTF-8'));
        $this->assertFalse(Str::position('Hello, World!', 'w', 0, 'UTF-8'));
        $this->assertFalse(Str::position('Hello, World!', 'X', 0, 'UTF-8'));
        $this->assertFalse(Str::position('', 'test'));
        $this->assertFalse(Str::position('Hello, World!', 'X'));
    }

    function testSubstrReplace()
    {
        $this->assertSame('12:00', Str::substrReplace('1200', ':', 2, 0));
        $this->assertSame('The Explosion Tools', Str::substrReplace('The Tools', 'Explosion ', 4, 0));
        $this->assertSame('Explosion – The PHP Tools for Web Artisans', Str::substrReplace('Explosion Tools', '– The PHP Tools for Web Artisans', 8));
    }

    function testTake()
    {
        $this->assertSame('ab', Str::take('abcdef', 2));
        $this->assertSame('ef', Str::take('abcdef', -2));
        $this->assertSame('', Str::take('abcdef', 0));
        $this->assertSame('', Str::take('', 2));
        $this->assertSame('abcdef', Str::take('abcdef', 10));
        $this->assertSame('abcdef', Str::take('abcdef', 6));
        $this->assertSame('ü', Str::take('üöä', 1));
    }

    function testLcfirst()
    {
        $this->assertSame('explosion', Str::lcfirst('Explosion'));
        $this->assertSame('explosion tools', Str::lcfirst('Explosion tools'));
        $this->assertSame('мама', Str::lcfirst('Мама'));
        $this->assertSame('мама мыла раму', Str::lcfirst('Мама мыла раму'));
    }

    function testUcfirst()
    {
        $this->assertSame('Explosion', Str::ucfirst('explosion'));
        $this->assertSame('Explosion tools', Str::ucfirst('explosion tools'));
        $this->assertSame('Мама', Str::ucfirst('мама'));
        $this->assertSame('Мама мыла раму', Str::ucfirst('мама мыла раму'));
    }

    function testUcsplit()
    {
        $this->assertSame(['Explosion_p_h_p_tools'], Str::ucsplit('Explosion_p_h_p_tools'));
        $this->assertSame(['Explosion_', 'P_h_p_tools'], Str::ucsplit('Explosion_P_h_p_tools'));
        $this->assertSame(['explosion', 'P', 'H', 'P', 'Tools'], Str::ucsplit('explosionPHPTools'));
        $this->assertSame(['Explosion-ph', 'P-tools'], Str::ucsplit('Explosion-phP-tools'));

        $this->assertSame(['Żółta', 'Łódka'], Str::ucsplit('ŻółtaŁódka'));
        $this->assertSame(['sind', 'Öde', 'Und', 'So'], Str::ucsplit('sindÖdeUndSo'));
        $this->assertSame(['Öffentliche', 'Überraschungen'], Str::ucsplit('ÖffentlicheÜberraschungen'));
    }

    function testUuid()
    {
        $this->assertInstanceOf(UuidInterface::class, Str::uuid());
        $this->assertInstanceOf(UuidInterface::class, Str::orderedUuid());
        $this->assertInstanceOf(UuidInterface::class, Str::uuid7());
    }

    function testAsciiNull()
    {
        $this->assertSame('', Str::ascii(null));
        $this->assertTrue(Str::isAscii(null));
        $this->assertSame('', Str::slug(null));
    }

    function testPadBoth()
    {
        $this->assertSame('__Alien___', Str::padBoth('Alien', 10, '_'));
        $this->assertSame('  Alien   ', Str::padBoth('Alien', 10));
        $this->assertSame('  ❤MultiByte☆   ', Str::padBoth('❤MultiByte☆', 16));
        $this->assertSame('❤☆❤MultiByte☆❤☆❤', Str::padBoth('❤MultiByte☆', 16, '❤☆'));
    }

    function testPadLeft()
    {
        $this->assertSame('-=-=-Alien', Str::padLeft('Alien', 10, '-='));
        $this->assertSame('     Alien', Str::padLeft('Alien', 10));
        $this->assertSame('     ❤MultiByte☆', Str::padLeft('❤MultiByte☆', 16));
        $this->assertSame('❤☆❤☆❤❤MultiByte☆', Str::padLeft('❤MultiByte☆', 16, '❤☆'));
    }

    function testPadRight()
    {
        $this->assertSame('Alien-=-=-', Str::padRight('Alien', 10, '-='));
        $this->assertSame('Alien     ', Str::padRight('Alien', 10));
        $this->assertSame('❤MultiByte☆     ', Str::padRight('❤MultiByte☆', 16));
        $this->assertSame('❤MultiByte☆❤☆❤☆❤', Str::padRight('❤MultiByte☆', 16, '❤☆'));
    }

    function testSwapKeywords(): void
    {
        $this->assertSame(
            'PHP 8 is fantastic',
            Str::swap([
                'PHP' => 'PHP 8',
                'awesome' => 'fantastic',
            ], 'PHP is awesome')
        );

        $this->assertSame(
            'foo bar baz',
            Str::swap([
                'ⓐⓑ' => 'baz',
            ], 'foo bar ⓐⓑ')
        );
    }

    function testWordCount()
    {
        $this->assertEquals(2, Str::wordCount('Hello, world!'));
        $this->assertEquals(10, Str::wordCount('Hi, this is my first contribution to the Explosion tools.'));

        $this->assertEquals(0, Str::wordCount('мама'));
        $this->assertEquals(0, Str::wordCount('мама мыла раму'));

        $this->assertEquals(1, Str::wordCount('мама', 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ'));
        $this->assertEquals(3, Str::wordCount('мама мыла раму', 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ'));

        $this->assertEquals(1, Str::wordCount('МАМА', 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ'));
        $this->assertEquals(3, Str::wordCount('МАМА МЫЛА РАМУ', 'абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ'));
    }

    function testWordWrap()
    {
        $this->assertEquals('Hello<br />World', Str::wordWrap('Hello World', 3, '<br />'));
        $this->assertEquals('Hel<br />lo<br />Wor<br />ld', Str::wordWrap('Hello World', 3, '<br />', true));

        $this->assertEquals('❤Multi<br />Byte☆❤☆❤☆❤', Str::wordWrap('❤Multi Byte☆❤☆❤☆❤', 3, '<br />'));
    }

    static function validUuidList()
    {
        return [
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de'],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1'],
            ['00000000-0000-0000-0000-000000000000'],
            ['e60d3f48-95d7-4d8d-aad0-856f29a27da2'],
            ['ff6f8cb0-c57d-11e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-21e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-31e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-41e1-9b21-0800200c9a66'],
            ['ff6f8cb0-c57d-51e1-9b21-0800200c9a66'],
            ['FF6F8CB0-C57D-11E1-9B21-0800200C9A66'],
        ];
    }

    static function invalidUuidList()
    {
        return [
            ['not a valid uuid so we can test this'],
            ['zf6f8cb0-c57d-11e1-9b21-0800200c9a66'],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1' . PHP_EOL],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1 '],
            [' 145a1e72-d11d-11e8-a8d5-f2801f1b9fd1'],
            ['145a1e72-d11d-11e8-a8d5-f2z01f1b9fd1'],
            ['3f6f8cb0-c57d-11e1-9b21-0800200c9a6'],
            ['af6f8cb-c57d-11e1-9b21-0800200c9a66'],
            ['af6f8cb0c57d11e19b210800200c9a66'],
            ['ff6f8cb0-c57da-51e1-9b21-0800200c9a66'],
        ];
    }

    static function uuidVersionList()
    {
        return [
            ['00000000-0000-0000-0000-000000000000', null, true],
            ['00000000-0000-0000-0000-000000000000', 0, true],
            ['00000000-0000-0000-0000-000000000000', 1, false],
            ['00000000-0000-0000-0000-000000000000', 42, false],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1', null, true],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1', 1, true],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1', 4, false],
            ['145a1e72-d11d-11e8-a8d5-f2801f1b9fd1', 42, false],
            ['ff6f8cb0-c57d-21e1-9b21-0800200c9a66', null, true],
            ['ff6f8cb0-c57d-21e1-9b21-0800200c9a66', 1, false],
            ['ff6f8cb0-c57d-21e1-9b21-0800200c9a66', 2, true],
            ['ff6f8cb0-c57d-21e1-9b21-0800200c9a66', 42, false],
            ['76a4ba72-cc4e-3e1d-b52d-856382f408c3', null, true],
            ['76a4ba72-cc4e-3e1d-b52d-856382f408c3', 1, false],
            ['76a4ba72-cc4e-3e1d-b52d-856382f408c3', 3, true],
            ['76a4ba72-cc4e-3e1d-b52d-856382f408c3', 42, false],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', null, true],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', 1, false],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', 4, true],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', 42, false],
            ['d3b2b5a9-d433-5c58-b038-4fa13696e357', null, true],
            ['d3b2b5a9-d433-5c58-b038-4fa13696e357', 1, false],
            ['d3b2b5a9-d433-5c58-b038-4fa13696e357', 5, true],
            ['d3b2b5a9-d433-5c58-b038-4fa13696e357', 42, false],
            ['1ef97d97-b5ab-67d8-9f12-5600051f1387', null, true],
            ['1ef97d97-b5ab-67d8-9f12-5600051f1387', 1, false],
            ['1ef97d97-b5ab-67d8-9f12-5600051f1387', 6, true],
            ['1ef97d97-b5ab-67d8-9f12-5600051f1387', 42, false],
            ['0192e4b9-92eb-7aec-8707-1becfb1e3eb7', null, true],
            ['0192e4b9-92eb-7aec-8707-1becfb1e3eb7', 1, false],
            ['0192e4b9-92eb-7aec-8707-1becfb1e3eb7', 7, true],
            ['0192e4b9-92eb-7aec-8707-1becfb1e3eb7', 42, false],
            ['07e80a1f-1629-831f-811f-c595103c91b5', null, true],
            ['07e80a1f-1629-831f-811f-c595103c91b5', 1, false],
            ['07e80a1f-1629-831f-811f-c595103c91b5', 8, true],
            ['07e80a1f-1629-831f-811f-c595103c91b5', 42, false],
            ['FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF', null, true],
            ['FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF', 1, false],
            ['FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF', 42, false],
            ['FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF', 'max', true],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', null, true],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', 1, false],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', 4, true],
            ['a0a2a2d2-0b87-4a18-83f2-2529882be2de', 42, false],
            ['zf6f8cb0-c57d-11e1-9b21-0800200c9a66', null, false],
            ['zf6f8cb0-c57d-11e1-9b21-0800200c9a66', 1, false],
            ['zf6f8cb0-c57d-11e1-9b21-0800200c9a66', 4, false],
            ['zf6f8cb0-c57d-11e1-9b21-0800200c9a66', 42, false],
        ];
    }



    function testMarkdown()
    {
        $this->assertSame("<p><em>hello world</em></p>\n", Str::markdown('*hello world*'));
        $this->assertSame("<h1>hello world</h1>\n", Str::markdown('# hello world'));
    }

    function testInlineMarkdown()
    {
        $this->assertSame("<em>hello world</em>\n", Str::inlineMarkdown('*hello world*'));
        $this->assertSame("<a href=\"https://explosion.com\"><strong>Explosion</strong></a>\n", Str::inlineMarkdown('[**Explosion**](https://explosion.com)'));
    }

    function testRepeat()
    {
        $this->assertSame('', Str::repeat('Hello', 0));
        $this->assertSame('Hello', Str::repeat('Hello', 1));
        $this->assertSame('aaaaa', Str::repeat('a', 5));
        $this->assertSame('', Str::repeat('', 5));
    }

    function testRepeatWhenTimesIsNegative()
    {
        $this->expectException(ValueError::class);
        Str::repeat('Hello', -2);
    }

    #[DataProvider('specialCharacterProvider')]
    function testTransliterate(string $value, string $expected): void
    {
        $this->assertSame($expected, Str::transliterate($value));
    }

    static function specialCharacterProvider(): array
    {
        return [
            ['ⓐⓑⓒⓓⓔⓕⓖⓗⓘⓙⓚⓛⓜⓝⓞⓟⓠⓡⓢⓣⓤⓥⓦⓧⓨⓩ', 'abcdefghijklmnopqrstuvwxyz'],
            ['⓪①②③④⑤⑥⑦⑧⑨⑩⑪⑫⑬⑭⑮⑯⑰⑱⑲⑳', '01234567891011121314151617181920'],
            ['⓵⓶⓷⓸⓹⓺⓻⓼⓽⓾', '12345678910'],
            ['⓿⓫⓬⓭⓮⓯⓰⓱⓲⓳⓴', '011121314151617181920'],
            ['ⓣⓔⓢⓣ@ⓛⓐⓡⓐⓥⓔⓛ.ⓒⓞⓜ', 'test@explosion.com'],
            ['🎂', '?'],
            ['abcdefghijklmnopqrstuvwxyz', 'abcdefghijklmnopqrstuvwxyz'],
            ['0123456789', '0123456789'],
        ];
    }

    function testTransliterateOverrideUnknown(): void
    {
        $this->assertSame('HHH', Str::transliterate('🎂🚧🏆', 'H'));
        $this->assertSame('Hello', Str::transliterate('🎂', 'Hello'));
    }

    #[DataProvider('specialCharacterProvider')]
    function testTransliterateStrict(string $value, string $expected): void
    {
        $this->assertSame($expected, Str::transliterate($value, '?', true));
    }

    function testItCanFreezeUuids()
    {
        $this->assertNotSame((string) Str::uuid(), (string) Str::uuid());
        $this->assertNotSame(Str::uuid(), Str::uuid());

        $uuid = Str::freezeUuids();

        $this->assertSame($uuid, Str::uuid());
        $this->assertSame(Str::uuid(), Str::uuid());
        $this->assertSame((string) $uuid, (string) Str::uuid());
        $this->assertSame((string) Str::uuid(), (string) Str::uuid());

        Str::createUuidsNormally();

        $this->assertNotSame(Str::uuid(), Str::uuid());
        $this->assertNotSame((string) Str::uuid(), (string) Str::uuid());
    }

    function testItCanFreezeUuidsInAClosure()
    {
        $uuids = [];

        $uuid = Str::freezeUuids(function ($uuid) use (&$uuids) {
            $uuids[] = $uuid;
            $uuids[] = Str::uuid();
            $uuids[] = Str::uuid();
        });

        $this->assertSame($uuid, $uuids[0]);
        $this->assertSame((string) $uuid, (string) $uuids[0]);
        $this->assertSame((string) $uuids[0], (string) $uuids[1]);
        $this->assertSame($uuids[0], $uuids[1]);
        $this->assertSame((string) $uuids[0], (string) $uuids[1]);
        $this->assertSame($uuids[1], $uuids[2]);
        $this->assertSame((string) $uuids[1], (string) $uuids[2]);
        $this->assertNotSame(Str::uuid(), Str::uuid());
        $this->assertNotSame((string) Str::uuid(), (string) Str::uuid());

        Str::createUuidsNormally();
    }

    function testItCreatesUuidsNormallyAfterFailureWithinFreezeMethod()
    {
        try {
            Str::freezeUuids(function () {
                Str::createUuidsUsing(fn() => Str::of('1234'));
                $this->assertSame('1234', Str::uuid()->toString());
                throw new \Exception('Something failed.');
            });
        } catch (\Exception $e) {
            $this->assertNotSame('1234', Str::uuid()->toString());
        }
    }

    function testItCanSpecifyASequenceOfUuidsToUtilise()
    {
        Str::createUuidsUsingSequence([
            0 => ($zeroth = Str::uuid()),
            1 => ($first = Str::uuid7()),
            // just generate a random one here...
            3 => ($third = Str::uuid()),
            // continue to generate random uuids...
        ]);

        $retrieved = Str::uuid();
        $this->assertSame($zeroth, $retrieved);
        $this->assertSame((string) $zeroth, (string) $retrieved);

        $retrieved = Str::uuid();
        $this->assertSame($first, $retrieved);
        $this->assertSame((string) $first, (string) $retrieved);

        $retrieved = Str::uuid();
        $this->assertFalse(in_array($retrieved, [$zeroth, $first, $third], true));
        $this->assertFalse(in_array((string) $retrieved, [(string) $zeroth, (string) $first, (string) $third], true));

        $retrieved = Str::uuid();
        $this->assertSame($third, $retrieved);
        $this->assertSame((string) $third, (string) $retrieved);

        $retrieved = Str::uuid();
        $this->assertFalse(in_array($retrieved, [$zeroth, $first, $third], true));
        $this->assertFalse(in_array((string) $retrieved, [(string) $zeroth, (string) $first, (string) $third], true));

        Str::createUuidsNormally();
    }

    function testItCanSpecifyAFallbackForASequence()
    {
        Str::createUuidsUsingSequence([Str::uuid(), Str::uuid()], fn() => throw new Exception('Out of Uuids.'));
        Str::uuid();
        Str::uuid();

        try {
            $this->expectExceptionMessage('Out of Uuids.');
            Str::uuid();
            $this->fail();
        } finally {
            Str::createUuidsNormally();
        }
    }

    function testItCanFreezeUlids()
    {
        $this->assertNotSame((string) Str::ulid(), (string) Str::ulid());
        $this->assertNotSame(Str::ulid(), Str::ulid());

        $ulid = Str::freezeUlids();

        $this->assertSame($ulid, Str::ulid());
        $this->assertSame(Str::ulid(), Str::ulid());
        $this->assertSame((string) $ulid, (string) Str::ulid());
        $this->assertSame((string) Str::ulid(), (string) Str::ulid());

        Str::createUlidsNormally();

        $this->assertNotSame(Str::ulid(), Str::ulid());
        $this->assertNotSame((string) Str::ulid(), (string) Str::ulid());
    }

    function testItCanFreezeUlidsInAClosure()
    {
        $ulids = [];

        $ulid = Str::freezeUlids(function ($ulid) use (&$ulids) {
            $ulids[] = $ulid;
            $ulids[] = Str::ulid();
            $ulids[] = Str::ulid();
        });

        $this->assertSame($ulid, $ulids[0]);
        $this->assertSame((string) $ulid, (string) $ulids[0]);
        $this->assertSame((string) $ulids[0], (string) $ulids[1]);
        $this->assertSame($ulids[0], $ulids[1]);
        $this->assertSame((string) $ulids[0], (string) $ulids[1]);
        $this->assertSame($ulids[1], $ulids[2]);
        $this->assertSame((string) $ulids[1], (string) $ulids[2]);
        $this->assertNotSame(Str::ulid(), Str::ulid());
        $this->assertNotSame((string) Str::ulid(), (string) Str::ulid());

        Str::createUlidsNormally();
    }

    function testItCreatesUlidsNormallyAfterFailureWithinFreezeMethod()
    {
        try {
            Str::freezeUlids(function () {
                Str::createUlidsUsing(fn() => Str::of('1234'));
                $this->assertSame('1234', (string) Str::ulid());
                throw new \Exception('Something failed');
            });
        } catch (\Exception $e) {
            $this->assertNotSame('1234', (string) Str::ulid());
        }
    }

    function testItCanSpecifyASequenceOfUlidsToUtilise()
    {
        Str::createUlidsUsingSequence([
            0 => ($zeroth = Str::ulid()),
            1 => ($first = Str::ulid()),
            // just generate a random one here...
            3 => ($third = Str::ulid()),
            // continue to generate random ulids...
        ]);

        $retrieved = Str::ulid();
        $this->assertSame($zeroth, $retrieved);
        $this->assertSame((string) $zeroth, (string) $retrieved);

        $retrieved = Str::ulid();
        $this->assertSame($first, $retrieved);
        $this->assertSame((string) $first, (string) $retrieved);

        $retrieved = Str::ulid();
        $this->assertFalse(in_array($retrieved, [$zeroth, $first, $third], true));
        $this->assertFalse(in_array((string) $retrieved, [(string) $zeroth, (string) $first, (string) $third], true));

        $retrieved = Str::ulid();
        $this->assertSame($third, $retrieved);
        $this->assertSame((string) $third, (string) $retrieved);

        $retrieved = Str::ulid();
        $this->assertFalse(in_array($retrieved, [$zeroth, $first, $third], true));
        $this->assertFalse(in_array((string) $retrieved, [(string) $zeroth, (string) $first, (string) $third], true));

        Str::createUlidsNormally();
    }

    function testItCanSpecifyAFallbackForAUlidSequence()
    {
        Str::createUlidsUsingSequence(
            [Str::ulid(), Str::ulid()],
            fn() => throw new Exception('Out of Ulids'),
        );
        Str::ulid();
        Str::ulid();

        try {
            $this->expectExceptionMessage('Out of Ulids');
            Str::ulid();
            $this->fail();
        } finally {
            Str::createUlidsNormally();
        }
    }

    function testPasswordCreation()
    {
        $this->assertTrue(strlen(Str::password()) === 32);

        $this->assertStringNotContainsString(' ', Str::password());
        $this->assertStringContainsString(' ', Str::password(spaces: true));

        $this->assertTrue(
            Str::of(Str::password())->contains(['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'])
        );
    }

    function testToBase64()
    {
        $this->assertSame(base64_encode('foo'), Str::toBase64('foo'));
        $this->assertSame(base64_encode('foobar'), Str::toBase64('foobar'));
    }

    function testFromBase64()
    {
        $this->assertSame('foo', Str::fromBase64(base64_encode('foo')));
        $this->assertSame('foobar', Str::fromBase64(base64_encode('foobar'), true));
    }

    function testChopStart()
    {
        foreach (
            [
                ['http://explosion.com', 'http://', 'explosion.com'],
                ['http://-http://', 'http://', '-http://'],
                ['http://explosion.com', 'htp:/', 'http://explosion.com'],
                ['http://explosion.com', 'http://www.', 'http://explosion.com'],
                ['http://explosion.com', '-http://', 'http://explosion.com'],
                ['http://explosion.com', ['https://', 'http://'], 'explosion.com'],
                ['http://www.explosion.com', ['http://', 'www.'], 'www.explosion.com'],
                ['http://http-is-fun.test', 'http://', 'http-is-fun.test'],
                ['🌊✋', '🌊', '✋'],
                ['🌊✋', '✋', '🌊✋'],
            ] as $value
        ) {
            [$subject, $needle, $expected] = $value;

            $this->assertSame($expected, Str::chopStart($subject, $needle));
        }
    }

    function testChopEnd()
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

    function testReplaceMatches()
    {
        // Test basic string replacement
        $this->assertSame('foo bar bar', Str::replaceMatches('/baz/', 'bar', 'foo baz bar'));
        $this->assertSame('foo baz baz', Str::replaceMatches('/404/', 'found', 'foo baz baz'));

        // Test with array of patterns
        $this->assertSame('foo XXX YYY', Str::replaceMatches(['/bar/', '/baz/'], ['XXX', 'YYY'], 'foo bar baz'));

        // Test with callback
        $result = Str::replaceMatches('/ba(.)/', function ($match) {
            return 'ba' . strtoupper($match[1]);
        }, 'foo baz bar');

        $this->assertSame('foo baZ baR', $result);

        $result = Str::replaceMatches('/(\d+)/', function ($match) {
            return $match[1] * 2;
        }, 'foo 123 bar 456');

        $this->assertSame('foo 246 bar 912', $result);

        // Test with limit parameter
        $this->assertSame('foo baz baz', Str::replaceMatches('/ba(.)/', 'ba$1', 'foo baz baz', 1));

        $result = Str::replaceMatches('/ba(.)/', function ($match) {
            return 'ba' . strtoupper($match[1]);
        }, 'foo baz baz bar', 1);

        $this->assertSame('foo baZ baz bar', $result);
    }

    function testPluralPascal(): void
    {
        // Test basic functionality with default count
        $this->assertSame('UserGroups', Str::pluralPascal('UserGroup'));
        $this->assertSame('ProductCategories', Str::pluralPascal('ProductCategory'));

        // Test with different count values and array
        $this->assertSame('UserGroups', Str::pluralPascal('UserGroup', 0)); // plural
        $this->assertSame('UserGroup', Str::pluralPascal('UserGroup', 1));  // singular
        $this->assertSame('UserGroups', Str::pluralPascal('UserGroup', 2)); // plural
        $this->assertSame('UserGroups', Str::pluralPascal('UserGroup', []));   // plural (empty array count is 0)

        // Test with Countable
        $countable = new class implements \Countable
        {
            function count(): int
            {
                return 3;
            }
        };

        $this->assertSame('UserGroups', Str::pluralPascal('UserGroup', $countable));
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
