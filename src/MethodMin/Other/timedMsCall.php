<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other{function timedMsCall(callable $callable):array{$m=\memory_get_usage(true);$ms=\Inilim\Tool\Method\Time\unixMs();$result=$callable();$ms=\Inilim\Tool\Method\Time\unixMs()-$ms;$m=\memory_get_usage(true)-$m;return['result'=>$result,'time'=>$ms,'memory'=>$m];}}namespace Inilim\Tool\Method\Time{if(!\Inilim\Tool\Time::__definedIfNot('unixMs')){
    function unixMs():int{$t=\microtime(false);return \intval(\substr($t,11).\substr($t,2,3));}
    }}