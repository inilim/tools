<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * Binary vector to array
 * @return float[]
 */
function vec_binVecToArray(string $vector): array
{
    return \array_values(\unpack('f*', $vector));
}
