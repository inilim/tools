<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @api
 * @author https://github.com/thesis-php/exceptionally
 *
 * @template T
 * @param callable(): (T|false) $function
 * @return T
 * @throws \ErrorException
 */
function exceptionally(callable $function, int $errorLevels = \E_ALL & ~\E_DEPRECATED & ~\E_USER_DEPRECATED)
{
    /** @var ?\Closure(int, string, string, int): bool */
    static $handler = null;

    $handler ??= static function (int $level, string $message, string $file, int $line): bool {
        /** @see https://www.php.net/manual/en/language.operators.errorcontrol.php */
        static $suppressedLevel = \E_ERROR | \E_CORE_ERROR | \E_COMPILE_ERROR | \E_USER_ERROR | \E_RECOVERABLE_ERROR | \E_PARSE;

        if (\error_reporting() === $suppressedLevel) {
            return true;
        }

        throw new \ErrorException(
            $message,
            0,
            $level,
            $file,
            $line
        );
    };

    \set_error_handler($handler, $errorLevels);

    try {
        /** @var T */
        return $function();
    } finally {
        \restore_error_handler();
    }
}
