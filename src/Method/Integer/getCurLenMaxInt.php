<?php

namespace Inilim\Method\Integer;

/**
 * @return int
 */
function getCurLenMaxInt()
{
    return \strlen(\strval(\PHP_INT_MAX));
}
