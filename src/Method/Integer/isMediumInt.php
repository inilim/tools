<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @param mixed $v
 * @return bool
 */
function isMediumInt($v)
{
    if (!\Inilim\Tool\Method\Integer\isNumeric($v)) return false;
    /** @var int|float|string $v */
    $value = \strval($v);
    /** @var string $value */
    if (\Inilim\Tool\Method\Integer\lenNumeric($value) > \Inilim\Tool\Integer::MEDIUM_INT_MAX_LENGHT) return false;

    return \Inilim\Tool\Method\Integer\checkBetween(
        $value,
        \Inilim\Tool\Integer::MEDIUM_INT_MIN,
        \Inilim\Tool\Integer::MEDIUM_INT_MAX
    );
}
