<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\VD{function trace(int $limit=0,bool $ignoreArgs=true){$options=\DEBUG_BACKTRACE_PROVIDE_OBJECT;if($ignoreArgs){$options |= \DEBUG_BACKTRACE_IGNORE_ARGS;}\Inilim\Tool\Method\VD\d(\debug_backtrace($options,$limit));}if(!\Inilim\Tool\VD::__definedIfNot('d')){
    function d(... $v){$isCLI=\in_array(\PHP_SAPI,['cli','phpdbg','embed'],true);\array_map(static function($i)use($isCLI){$t=\preg_replace('#Object[\n\r\t\s]++\*RECURSION\*#','Object *RECURSION*',\print_r($i,true));if($isCLI){echo $t;echo PHP_EOL;}else{echo '<pre style="display: block;white-space: pre;padding: 5px;overflow: initial !important;">';echo $t;echo '</pre>';}},$v);if($isCLI){echo PHP_EOL;}else{echo '<br>';}}
    }}