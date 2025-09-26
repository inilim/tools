<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * is not php function \error_clear_last()
 */
function errorClearLast(): void
{
    \Inilim\Tool\Method\Other\__state()->error = null;
}
