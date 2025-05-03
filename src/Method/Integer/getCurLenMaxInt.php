<?php

namespace Inilim\Tool\Method\Integer;

function getCurLenMaxInt(): int
{
    return \strlen(\strval(\PHP_INT_MAX));
}
