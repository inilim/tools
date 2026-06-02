<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * @build_skip
 * @param callable $callback
 * @param mixed[] $args
 */
function obWrap(callable $callback, array $args): ?string
{
    $result = \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(
        static function () use ($callback, $args) {
            $curLvl = \ob_get_level();
            if (!\ob_start()) {
                return null;
            }

            try {
                $callback(...$args);
                return \ob_get_clean();
            } finally {
                // Гарантированно очищаем буфер, если произошло исключение
                if (\ob_get_level() > $curLvl) {
                    \ob_end_clean();
                }
            }
        }
    );

    return \is_string($result) ? $result : null;
}
