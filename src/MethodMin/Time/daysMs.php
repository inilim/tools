<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time{function daysMs(int $days):int{return \Inilim\Tool\Method\Time\daysSec($days)*1000;}if(!\Inilim\Tool\Time::__definedIfNot('daysSec')){
    function daysSec(int $days):int{return 86400*$days;}
    }}