<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

// use Inilim\Dump\Dump;
// 
// require_once __DIR__ . '/../../../vendor/autoload.php';
// 
// Dump::init();

/**
 * @template TResult of mixed
 * @template TObj of \stdClass
 * @param callable(TObj):TResult $callable
 * @param null|callable(int $levelOrCode,string $message,string $file,int $line,array{exception?:\Throwable,isException:bool,isSuppress:bool,obj:TObj} $context) $handler
 * @return TResult
 */
function tryCallWithErrHandler(callable $callable, ?callable $handler, int $errorLevels = \E_ALL)
{
    $use = [
        'handler'   => $handler,
        'exception' => null,
        'result'    => null,
        'obj'       => new \stdClass,
    ];
    $wrapHandler = static function ($levelOrCode, $message, $file, $line, $context = []) use (&$use) {
        // возвращаем true чтобы глушить внутренний обработчик ошибок
        if ($use['handler'] === null) return true;

        $context['isException'] = isset($context['exception']);
        $context['isSuppress']  = $context['isException'] ? false : !(\error_reporting() & $levelOrCode);
        $context['obj']         = $use['obj'];
        try {
            $handlerResult = $use['handler'](
                $levelOrCode,
                $message,
                $file,
                $line,
                $context
            );
        } catch (\Throwable $e) {
            $use['exception'] = $e;
            throw $e;
        }

        return $handlerResult !== false ? true : false;
    };

    \set_error_handler($wrapHandler, $errorLevels);
    try {
        $use['result'] = $callable($use['obj']);
    } catch (\Throwable $e) {
        \restore_error_handler();
        // Если исключение было выброшено внутри обработчика ошибок
        if ($use['exception']) {
            throw $use['exception'];
        }
        // Если исключение было выброшено внутри callable, тогда передаем исключение обработчику ошибок
        $wrapHandler->__invoke(
            $e->getCode(),      // $levelOrCode
            $e->getMessage(),   // $message
            $e->getFile(),      // $file
            $e->getLine(),      // $line
            ['exception' => $e] // $context
        );
        return $use['result'];
    }
    \restore_error_handler();

    return $use['result'];
}
