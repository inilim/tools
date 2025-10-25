<?php

namespace Inilim\Tool\Test\Method\File;

use Inilim\Tool\File;
use Inilim\Tool\Test\TestCase;
use Symfony\Component\Finder\Finder;

class toCharsGenerator_v2Test extends TestCase
{
    function test()
    {
        // по дефолтному чанку
        $res = \tmpfile();
        \fwrite($res, 'abcd_абв');
        $ptf = \stream_get_meta_data($res)['uri'];

        $callback = File::toCharsGenerator_v2($ptf);
        $this->assertInstanceOf(\Closure::class, $callback);
        $this->assertInstanceOf(\Generator::class, $callback());

        $array = [];
        foreach ($callback() as $info => $text) {
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
        // пару символов
        $res = \tmpfile();
        \fwrite($res, 'abcd_абв');
        $ptf = \stream_get_meta_data($res)['uri'];

        $callback = File::toCharsGenerator_v2($ptf, 2);

        $array = [];
        foreach ($callback() as $info => $text) {
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

    function test2()
    {
        // проверка текста с переносом строки
        $res = \tmpfile();
        \fwrite($res, "a\nа");
        $ptf = \stream_get_meta_data($res)['uri'];

        $callback = File::toCharsGenerator_v2($ptf);

        $array = [];
        foreach ($callback() as $info => $text) {
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
            $this->assertSame("\n", $text);
            unset($array[$idx]);
            break;
        }

        foreach ($array as $idx => [$info, $text]) {
            $this->assertSame(2, $info['iter']);
            $this->assertSame(2, $info['posFrom']);
            $this->assertSame(4, $info['posTo']);
            $this->assertSame('а', $text);
            unset($array[$idx]);
            break;
        }

        $this->assertTrue(empty($array));
    }

    function testRealFile()
    {
        $finder = (new Finder)->in(\dirname(__DIR__, 2) . '/files')->files();

        foreach ($finder as $ptf => $_) {
            $contentHash = \md5_file($ptf);
            $callback = File::toCharsGenerator_v2($ptf, 11);

            $txtHash = '';
            foreach ($callback() as $substr) {
                $txtHash .= $substr;
            }
            $txtHash = \md5($txtHash);
            $this->assertSame($contentHash, $txtHash);
        }
    }

    function testRealFile2()
    {
        $finder = (new Finder)->in(\dirname(__DIR__, 2) . '/files')->files();

        foreach ($finder as $ptf => $_) {
            $contentHash = \md5_file($ptf);
            $callback = File::toCharsGenerator_v2($ptf, 22);

            $txtHash = '';
            foreach ($callback() as $substr) {
                $txtHash .= $substr;
            }
            $txtHash = \md5($txtHash);
            $this->assertSame($contentHash, $txtHash);
        }
    }

    function testBrokenString()
    {
        // если в строке встречаются разорванная суррогатная пара
        $brokenString = \substr('бвгд', 0, 3);
        $res = \tmpfile();
        \fwrite($res, $brokenString);
        $ptf = \stream_get_meta_data($res)['uri'];
        $callback = File::toCharsGenerator_v2($ptf);

        $txt = '';
        foreach ($callback() as $substr) {
            $txt .= $substr;
        }

        \fclose($res);
        @\unlink($ptf);

        $this->assertSame($brokenString, $txt);
    }

    function testEmpty()
    {
        $res = \tmpfile();
        $ptf = \stream_get_meta_data($res)['uri'];
        $callback = File::toCharsGenerator_v2($ptf);

        $array = [];
        foreach ($callback() as $text) {
            $array[] = '';
        }

        \fclose($res);
        @\unlink($ptf);

        $this->assertTrue(empty($array));
    }

    function testEx()
    {
        $this->expectException(\InvalidArgumentException::class);
        File::toCharsGenerator_v2('not found file', 1);
    }

    function testEx2()
    {
        $this->expectException(\InvalidArgumentException::class);
        $res = \tmpfile();
        $ptf = \stream_get_meta_data($res)['uri'];
        File::toCharsGenerator_v2($ptf, 0);
    }
}
