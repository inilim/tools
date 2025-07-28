<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other{function timedMsCall(callable $callable):array{$m=\memory_get_usage(true);$ms=\Inilim\Tool\Method\Time\unixMs();$result=$callable();$ms=\Inilim\Tool\Method\Time\unixMs()-$ms;$m=\memory_get_usage(true)-$m;return \Inilim\Tool\Method\Other\_refDots(['result'=>$result,'time'=>$ms,'memory'=>$m]);}if(!\Inilim\Tool\Other::__definedIfNot('_refDots')){
    function _refDots(array $array):array{$dots=[];foreach($array as&$value){$dots[]=&$value;}$array['...']=$dots;return $array;}
    }}namespace Inilim\Tool\Method\Time{if(!\Inilim\Tool\Time::__definedIfNot('unixMs')){
    function unixMs():int{$t=\microtime(false);return \intval(\substr($t,11).\substr($t,2,3));}
    }}