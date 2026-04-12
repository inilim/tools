<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF;

/**
 * @author kylekatarnls <kylekatarnls@gmail.com>
 * 
 * @template Value
 * @template Minimum
 * @template Maximum
 *
 * @param Value   $value
 * @param Minimum $min
 * @param Maximum $max
 *
 * @return Value|Minimum|Maximum
 */
function clamp($value, $min, $max)
{
    if (\Inilim\Tool\Method\Check\php86()) {
        return \clamp($value, $min, $max);
    }

    if (\is_float($min) && \is_nan($min)) {
        \Inilim\Tool\Method\Other\throwValueErrorIfAvailable(\Inilim\Tool\PF::class . '::clamp(): Argument #2 ($min) must not be NAN');
    }

    if (\is_float($max) && \is_nan($max)) {
        \Inilim\Tool\Method\Other\throwValueErrorIfAvailable(\Inilim\Tool\PF::class . '::clamp(): Argument #3 ($max) must not be NAN');
    }

    if ($max < $min) {
        \Inilim\Tool\Method\Other\throwValueErrorIfAvailable(\Inilim\Tool\PF::class . '::clamp(): Argument #2 ($min) must be smaller than or equal to argument #3 ($max)');
    }

    if ($value > $max) {
        return $max;
    }

    if ($value < $min) {
        return $min;
    }

    return $value;
}
