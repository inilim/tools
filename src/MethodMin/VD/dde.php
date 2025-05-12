<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\VD{function dde(... $v){if(($cur=\ob_get_level())>1){while(true){if(\ob_get_level()===1){break;}\ob_end_clean();}echo \sprintf('__CLIPBOARD__: "%s"',$cur).PHP_EOL;}\Inilim\Tool\Method\VD\dd(... $v);exit;}if(!\Inilim\Tool\VD::__definedIfNot('dd')){
    function dd(... $v){\ob_start();\var_dump(... $v);$t=\preg_replace('#\]\=\>[\n\r\t\s]++#','] => ',\strval(\ob_get_clean()));if(\in_array(\PHP_SAPI,['cli','phpdbg','embed'],true)){echo $t;echo PHP_EOL;}else{echo '<pre style="display: block;white-space: pre;padding: 5px;overflow: initial !important;">';echo $t;echo '</pre>';}}
    }}