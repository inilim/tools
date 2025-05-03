<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

function getCurLenMaxInt():int{return \strlen(\strval(\PHP_INT_MAX));}