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
