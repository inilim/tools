<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\FS;

function mbToBytes(int $mb):int{return 8388608*$mb;}