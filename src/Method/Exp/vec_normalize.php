<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * Normalize a vector.
 * @param float[] $vector
 * @return array{0:float[],1:float}
 */
function vec_normalize(array $vector): array
{
    $sum = 0.0;

    // Compute the sum of squares.
    foreach ($vector as $val) {
        $sum += $val * $val;
    }

    // Compute the norm.
    $norm = \sqrt($sum);

    // Avoid division by zero.
    if ($norm == 0.0) {
        $norm = 1.0;
    }

    // Pre-calculate reciprocal to avoid repeated division.
    $inv = 1.0 / $norm;

    // Normalize each element.
    foreach ($vector as $i => $val) {
        $vector[$i] *= $inv;
    }

    return [$vector, $norm];
}
