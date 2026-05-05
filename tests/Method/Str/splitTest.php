<?php

namespace Inilim\Tool\Test\Method\Str;

use Inilim\Tool\Str;

/**
 */
class splitTest extends \Inilim\Tool\Test\TestCase
{
    /**
     * Проверяет, что генератор возвращает правильные части для пустой строки.
     */
    function testEmptyString(): void
    {
        $generator = Str::split('');
        $this->assertInstanceOf(\Generator::class, $generator);
        $this->assertSame([], \iterator_to_array($generator));
    }

    /**
     * @dataProvider asciiDataProvider
     */
    function testAsciiString(string $input, int $length, array $expectedParts): void
    {
        $generator = Str::split($input, $length);
        $actual = \iterator_to_array($generator);
        $this->assertSame($expectedParts, $actual);
    }

    static function asciiDataProvider(): array
    {
        return [
            'ASCII по 1 символу'     => ['Hello', 1, ['H', 'e', 'l', 'l', 'o']],
            'ASCII по 2 символа'     => ['Hello', 2, ['He', 'll', 'o']],
            'Длина больше строки'    => ['Hi', 5, ['Hi']],
            'Длина равна строке'     => ['Test', 4, ['Test']],
        ];
    }

    /**
     * @dataProvider utf8DataProvider
     */
    function testUtf8String(string $input, int $length, array $expectedParts): void
    {
        $generator = Str::split($input, $length);
        $actual = \iterator_to_array($generator);
        $this->assertSame($expectedParts, $actual);
    }

    static function utf8DataProvider(): array
    {
        return [
            'Русские буквы по 1'             => ['Привет', 1, ['П', 'р', 'и', 'в', 'е', 'т']],
            'Русские буквы по 2'             => ['Привет', 2, ['Пр', 'ив', 'ет']],
            'Эмодзи по 1'                    => ['😀😃😄', 1, ['😀', '😃', '😄']],
            'Эмодзи по 2'                    => ['😀😃😄', 2, ['😀😃', '😄']],
            'Смесь ASCII и UTF-8 по 3'       => ['aбвгд', 3, ['aбв', 'гд']],
            'Длина больше строки (UTF-8)'    => ['Кошка', 10, ['Кошка']],
        ];
    }

    /**
     * Проверяет корректную работу со смещением (offset) внутри генератора
     * для многобайтовых строк. Имитируем ручной проход, чтобы убедиться,
     * что подстроки вырезаются правильно.
     */
    function testOffsetHandlingWithUtf8(): void
    {
        $string = 'Привет, мир!';
        $generator = Str::split($string, 3);

        $expected = ['При', 'вет', ', м', 'ир!'];
        $actual = \iterator_to_array($generator);

        $this->assertSame($expected, $actual);
    }

    /**
     * Проверяет, что генератор выдаёт правильные ключи (0, 1, 2, ...)
     */
    function testGeneratorYieldsSequentialKeys(): void
    {
        $generator = Str::split('ABCDEF', 2);
        $keys = [];
        foreach ($generator as $key => $value) {
            $keys[] = $key;
        }
        $this->assertSame([0, 1, 2], $keys);
    }

    /**
     * @dataProvider invalidLengthDataProvider
     */
    function testInvalidLengthThrowsException(int $invalidLength): void
    {
        $this->expectException(\InvalidArgumentException::class);
        // Предполагается, что Assert::positiveInteger выбрасывает InvalidArgumentException
        // для length <= 0. Если Assert отсутствует, тест должен упасть.
        \iterator_to_array(Str::split('test', $invalidLength));
    }

    static function invalidLengthDataProvider(): array
    {
        return [
            'длина 0'   => [0],
            'отрицательная' => [-5],
        ];
    }

    /**
     * Проверяем случай, когда длина = 1 для длинной строки – должно быть много итераций,
     * но без ошибок памяти.
     */
    function testLargeStringWithLengthOne(): void
    {
        $longString = \str_repeat('x', 10000);
        $generator = Str::split($longString, 1);
        $count = 0;
        foreach ($generator as $char) {
            $this->assertSame('x', $char);
            $count++;
        }
        $this->assertSame(10000, $count);
    }
}
