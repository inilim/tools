<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time{function dateMs(string $format,?int $timestampMs=null){if($timestampMs!==null){$timestampMs=\Inilim\Tool\Method\Time\msToSec($timestampMs);}return \date($format,$timestampMs);}if(!\Inilim\Tool\Time::__definedIfNot('msToSec')){
    function msToSec(int $ms):int{return \intval($ms*0.001);}
    }}