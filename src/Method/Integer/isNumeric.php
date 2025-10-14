<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

/**
 * NOT like \is_numeric()
 * функция не проверяет длину значения, будет true даже с bigint и более.
 * @param mixed $v
 */
function isNumeric($v): bool
{
    $t = \gettype($v);
    if (!\in_array($t, ['string', 'integer'], true)) {
        return false;
    }
    /** @var string|int $v */
    // if ($t === 'string' && \strpos($v, '.') !== false) {
    // return false;
    // }
    // INFO сверх большие int. потеря точности из-за ограничений представления чисел с плавающей точкой в PHP
    // \preg_match('#^\-?[1-9][0-9]{0,}$|^0$#', \sprintf('%.0f', $v))
    if ($t === 'integer' || \preg_match('#^\-?[1-9][0-9]{0,}$|^0$#', $v)) {
        return true;
    }

    return false;
}
