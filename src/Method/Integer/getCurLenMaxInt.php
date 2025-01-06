<?php

namespace Inilim\Tool\Method\Integer;

/**
 * @return int
 */
function getCurLenMaxInt()
{
    return \strlen(\strval(\PHP_INT_MAX));
}
