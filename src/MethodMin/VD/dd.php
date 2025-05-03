<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\VD;

function dd(... $v){if(\in_array(\PHP_SAPI,['cli','phpdbg','embed'],true)){\var_dump(... $v);echo PHP_EOL;}else{echo '<pre style="display: block;white-space: pre;padding: 5px;overflow: initial !important;">';\var_dump(... $v);echo '</pre>';}}