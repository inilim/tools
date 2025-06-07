<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time{function monthsMs(int $months):int{return \Inilim\Tool\Method\Time\monthsSec($months)*1000;}if(!\Inilim\Tool\Time::__definedIfNot('monthsSec')){
    function monthsSec(int $months):int{return 2592000*$months;}
    }}