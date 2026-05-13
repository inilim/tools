<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * Normalized vector to binary.
 * @param float[] $vector
 */
function vec_normalVecToBin(array $vector): string
{
    return \pack('f*', ...$vector);
}
