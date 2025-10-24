<?php

namespace Inilim\Tool\Test\Method\File;

use Inilim\Tool\File;
use Inilim\Tool\Test\TestCase;

class toCharsGeneratorTest extends TestCase
{
    function test()
    {
        $res = \tmpfile();
        \fwrite($res, 'abcd_абв');
        $ptf = \stream_get_meta_data($res)['uri'];

        $gen = File::toCharsGenerator($ptf, 1);
        $this->assertInstanceOf(\Generator::class, $gen);

        $array = [];
        foreach ($gen as $info => $text) {
            $array[] = [$info, $text];
        }

        \fclose($res);
        @\unlink($ptf);

        foreach ($array as $idx => [$info, $text]) {
            $this->assertSame(0, $info['iter']);
            $this->assertSame(0, $info['posFrom']);
            $this->assertSame(1, $info['posTo']);
            $this->assertSame('a', $text);
            unset($array[$idx]);
            break;
        }

        foreach ($array as $idx => [$info, $text]) {
            $this->assertSame(1, $info['iter']);
            $this->assertSame(1, $info['posFrom']);
            $this->assertSame(2, $info['posTo']);
            $this->assertSame('b', $text);
            unset($array[$idx]);
            break;
        }

        foreach ($array as $idx => [$info, $text]) {
            $this->assertSame(2, $info['iter']);
            $this->assertSame(2, $info['posFrom']);
            $this->assertSame(3, $info['posTo']);
            $this->assertSame('c', $text);
            unset($array[$idx]);
            break;
        }

        foreach ($array as $idx => [$info, $text]) {
            $this->assertSame(3, $info['iter']);
            $this->assertSame(3, $info['posFrom']);
            $this->assertSame(4, $info['posTo']);
            $this->assertSame('d', $text);
            unset($array[$idx]);
            break;
        }

        foreach ($array as $idx => [$info, $text]) {
            $this->assertSame(4, $info['iter']);
            $this->assertSame(4, $info['posFrom']);
            $this->assertSame(5, $info['posTo']);
            $this->assertSame('_', $text);
            unset($array[$idx]);
            break;
        }

        foreach ($array as $idx => [$info, $text]) {
            $this->assertSame(5, $info['iter']);
            $this->assertSame(5, $info['posFrom']);
            $this->assertSame(7, $info['posTo']);
            $this->assertSame('а', $text);
            unset($array[$idx]);
            break;
        }

        foreach ($array as $idx => [$info, $text]) {
            $this->assertSame(6, $info['iter']);
            $this->assertSame(7, $info['posFrom']);
            $this->assertSame(9, $info['posTo']);
            $this->assertSame('б', $text);
            unset($array[$idx]);
            break;
        }

        foreach ($array as $idx => [$info, $text]) {
            $this->assertSame(7, $info['iter']);
            $this->assertSame(9, $info['posFrom']);
            $this->assertSame(11, $info['posTo']);
            $this->assertSame('в', $text);
            unset($array[$idx]);
            break;
        }

        $this->assertTrue(empty($array));
    }

    function test1()
    {
        $res = \tmpfile();
        \fwrite($res, 'abcd_абв');
        $ptf = \stream_get_meta_data($res)['uri'];

        $gen = File::toCharsGenerator($ptf, 2);

        $array = [];
        foreach ($gen as $info => $text) {
            $array[] = [$info, $text];
        }

        \fclose($res);
        @\unlink($ptf);

        foreach ($array as $idx => [$info, $text]) {
            $this->assertSame(0, $info['iter']);
            $this->assertSame(0, $info['posFrom']);
            $this->assertSame(2, $info['posTo']);
            $this->assertSame('ab', $text);
            unset($array[$idx]);
            break;
        }

        foreach ($array as $idx => [$info, $text]) {
            $this->assertSame(1, $info['iter']);
            $this->assertSame(2, $info['posFrom']);
            $this->assertSame(4, $info['posTo']);
            $this->assertSame('cd', $text);
            unset($array[$idx]);
            break;
        }

        foreach ($array as $idx => [$info, $text]) {
            $this->assertSame(2, $info['iter']);
            $this->assertSame(4, $info['posFrom']);
            $this->assertSame(7, $info['posTo']);
            $this->assertSame('_а', $text);
            unset($array[$idx]);
            break;
        }

        foreach ($array as $idx => [$info, $text]) {
            $this->assertSame(3, $info['iter']);
            $this->assertSame(7, $info['posFrom']);
            $this->assertSame(11, $info['posTo']);
            $this->assertSame('бв', $text);
            unset($array[$idx]);
            break;
        }

        $this->assertTrue(empty($array));
    }

    function testEmpty()
    {
        $res = \tmpfile();
        $ptf = \stream_get_meta_data($res)['uri'];
        $gen = File::toCharsGenerator($ptf, 1);

        $array = [];
        foreach ($gen as $text) {
            $array[] = '';
        }

        \fclose($res);
        @\unlink($ptf);

        $this->assertTrue(empty($array));
    }

    function testEx()
    {
        $this->expectException(\InvalidArgumentException::class);
        foreach (File::toCharsGenerator('not found file', 1) as $_) {
        }
    }

    function testEx2()
    {
        $this->expectException(\InvalidArgumentException::class);
        $res = \tmpfile();
        $ptf = \stream_get_meta_data($res)['uri'];
        foreach (File::toCharsGenerator($ptf, 0) as $_) {
        }
    }
}
