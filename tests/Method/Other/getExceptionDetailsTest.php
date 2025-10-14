<?php

declare(strict_types=1);

use Inilim\Tool\Other;

class getExceptionDetailsTest extends \Inilim\Tool\Test\TestCase
{
    function testDefaultException()
    {
        $Exception = new \Exception();
        $details = Other::getExceptionDetails($Exception);

        $this->assertSame(\get_class($Exception), $details['class']);
        $this->assertSame($Exception->getCode(), $details['code']);
        $this->assertSame($Exception->getFile(), $details['file']);
        $this->assertSame($Exception->getLine(), $details['line']);
        $this->assertSame($Exception->getMessage(), $details['message']);
        $this->assertSame($Exception->getTraceAsString(), $details['trace']);
        $this->assertFalse(isset($details['...']));

        $Exception = new \Exception('message', 777);
        $details = Other::getExceptionDetails($Exception, true);

        $this->assertSame(\get_class($Exception), $details['class']);
        $this->assertSame(777, $details['code']);
        $this->assertSame($Exception->getFile(), $details['file']);
        $this->assertSame($Exception->getLine(), $details['line']);
        $this->assertSame('message', $details['message']);
        $this->assertSame($Exception->getMessage(), $details['message']);
        $this->assertSame($Exception->getTrace(), $details['trace']);
        $this->assertFalse(isset($details['...']));
    }

    function testErrorException()
    {
        $Exception = new \Error();
        $details = Other::getExceptionDetails($Exception);

        $this->assertSame(\get_class($Exception), $details['class']);
        $this->assertSame($Exception->getCode(), $details['code']);
        $this->assertSame($Exception->getFile(), $details['file']);
        $this->assertSame($Exception->getLine(), $details['line']);
        $this->assertSame($Exception->getMessage(), $details['message']);
        $this->assertSame($Exception->getTraceAsString(), $details['trace']);
        $this->assertFalse(isset($details['...']));

        $Exception = new \Error('message', 777);
        $details = Other::getExceptionDetails($Exception, true);

        $this->assertSame(\get_class($Exception), $details['class']);
        $this->assertSame(777, $details['code']);
        $this->assertSame($Exception->getFile(), $details['file']);
        $this->assertSame($Exception->getLine(), $details['line']);
        $this->assertSame('message', $details['message']);
        $this->assertSame($Exception->getTrace(), $details['trace']);
        $this->assertFalse(isset($details['...']));
    }

    function testDots()
    {
        $Exception = new \InvalidArgumentException();
        $details = Other::getExceptionDetails($Exception, false, true);

        $this->assertSame(\get_class($Exception), $details['class']);
        $this->assertSame($Exception->getCode(), $details['code']);
        $this->assertSame($Exception->getFile(), $details['file']);
        $this->assertSame($Exception->getLine(), $details['line']);
        $this->assertSame($Exception->getMessage(), $details['message']);
        $this->assertSame($Exception->getTraceAsString(), $details['trace']);
        $this->assertTrue(isset($details['...']));

        // Проверка порядка
        [$message, $line, $code, $file, $trace, $class] = $details['...'];

        $this->assertSame($message, $details['message']);
        $this->assertSame($line, $details['line']);
        $this->assertSame($code, $details['code']);
        $this->assertSame($file, $details['file']);
        $this->assertSame($trace, $details['trace']);
        $this->assertSame($class, $details['class']);

        $this->assertSame($Exception->getMessage(), $message);
        $this->assertSame($Exception->getLine(), $line);
        $this->assertSame($Exception->getCode(), $code);
        $this->assertSame($Exception->getFile(), $file);
        $this->assertSame($Exception->getTraceAsString(), $trace);
        $this->assertSame(\get_class($Exception), $class);

        $this->assertSame($details['...'][0], $details['message']);
        $this->assertSame($details['...'][1], $details['line']);
        $this->assertSame($details['...'][2], $details['code']);
        $this->assertSame($details['...'][3], $details['file']);
        $this->assertSame($details['...'][4], $details['trace']);
        $this->assertSame($details['...'][5], $details['class']);

        // Проверяем изменение по ссылке

        $details['...'][0] = null;
        $this->assertSame(null, $details['message']);
        $details['...'][1] = null;
        $this->assertSame(null, $details['line']);
        $details['...'][2] = null;
        $this->assertSame(null, $details['code']);
        $details['...'][3] = null;
        $this->assertSame(null, $details['file']);
        $details['...'][4] = null;
        $this->assertSame(null, $details['trace']);
        $details['...'][5] = null;
        $this->assertSame(null, $details['class']);

        // ---------------------------------------------
        // 
        // ---------------------------------------------

        $Exception = new \InvalidArgumentException('message', 777);
        $details = Other::getExceptionDetails($Exception, true, true);

        $this->assertSame(\get_class($Exception), $details['class']);
        $this->assertSame(777, $details['code']);
        $this->assertSame($Exception->getFile(), $details['file']);
        $this->assertSame($Exception->getLine(), $details['line']);
        $this->assertSame('message', $details['message']);
        $this->assertSame($Exception->getTrace(), $details['trace']);
        $this->assertTrue(isset($details['...']));

        // Проверка порядка
        [$message, $line, $code, $file, $trace, $class] = $details['...'];

        $this->assertSame($message, $details['message']);
        $this->assertSame($line, $details['line']);
        $this->assertSame($code, $details['code']);
        $this->assertSame($file, $details['file']);
        $this->assertSame($trace, $details['trace']);
        $this->assertSame($class, $details['class']);

        $this->assertSame('message', $message);
        $this->assertSame($Exception->getLine(), $line);
        $this->assertSame(777, $code);
        $this->assertSame($Exception->getFile(), $file);
        $this->assertSame($Exception->getTrace(), $trace);
        $this->assertSame(\get_class($Exception), $class);

        $this->assertSame($details['...'][0], $details['message']);
        $this->assertSame($details['...'][1], $details['line']);
        $this->assertSame($details['...'][2], $details['code']);
        $this->assertSame($details['...'][3], $details['file']);
        $this->assertSame($details['...'][4], $details['trace']);
        $this->assertSame($details['...'][5], $details['class']);

        // Проверяем изменение по ссылке

        $details['message'] = null;
        $this->assertSame($details['...'][0], null);
        $details['line'] = null;
        $this->assertSame($details['...'][1], null);
        $details['code'] = null;
        $this->assertSame($details['...'][2], null);
        $details['file'] = null;
        $this->assertSame($details['...'][3], null);
        $details['trace'] = null;
        $this->assertSame($details['...'][4], null);
        $details['class'] = null;
        $this->assertSame($details['...'][5], null);
    }
}
