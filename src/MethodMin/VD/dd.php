<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\VD;

function dd(){if(\in_array(\PHP_SAPI,['cli','phpdbg','embed'],true)){\var_dump(... \func_get_args());echo PHP_EOL;}else{echo '<pre style="display: block;white-space: pre;padding: 5px;overflow: initial !important;">';\var_dump(... \func_get_args());echo '</pre>';}}