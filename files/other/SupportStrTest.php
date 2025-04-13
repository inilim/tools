<?php

namespace Illuminate\Tests\Support;

use Exception;
use ValueError;
use Inilim\Tool\Str;
use ReflectionClass;
use Ramsey\Uuid\UuidInterface;
use PHPUnit\Framework\Attributes\DataProvider;

// @see https://github.com/laravel/framework/blob/12.x/tests/Support/SupportStrTest.php

class SupportStrTest extends \Inilim\Tool\Test\TestCase
{
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

    function testIsUrl()
    {
        $this->assertTrue(Str::isUrl('https://explosion.com'));
        $this->assertTrue(Str::isUrl('http://localhost'));
        $this->assertFalse(Str::isUrl('invalid url'));
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

    // alias studly
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

    // ---------------------------------------------
    // 
    // ---------------------------------------------

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

    function testAsciiNull()
    {
        $this->assertSame('', Str::ascii(null));
        $this->assertTrue(Str::isAscii(null));
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

    function testSwapKeywords()
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
    function testTransliterate(string $value, string $expected)
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

    function testTransliterateOverrideUnknown()
    {
        $this->assertSame('HHH', Str::transliterate('🎂🚧🏆', 'H'));
        $this->assertSame('Hello', Str::transliterate('🎂', 'Hello'));
    }

    #[DataProvider('specialCharacterProvider')]
    function testTransliterateStrict(string $value, string $expected)
    {
        $this->assertSame($expected, Str::transliterate($value, '?', true));
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

    function testPluralPascal()
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
