<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\VD;

function d(){$isCLI=\in_array(\PHP_SAPI,['cli','phpdbg','embed'],true);\array_map(static function($i)use($isCLI){if($isCLI){\print_r($i);echo PHP_EOL;}else{echo '<pre style="display: block;white-space: pre;padding: 5px;overflow: initial !important;">';\print_r($i);echo '</pre>';}},\func_get_args());if($isCLI){echo PHP_EOL;}else{echo '<br>';}}