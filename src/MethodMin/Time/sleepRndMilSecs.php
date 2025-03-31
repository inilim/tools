<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time{function sleepRndMilSecs(int $min,int $max){\Inilim\Tool\Method\Time\sleepMilSecs(\mt_rand($min,$max));}if(!\Inilim\Tool\Time::__definedIfNot('sleepMilSecs')){
    function sleepMilSecs(int $v){\usleep(1000*$v);}
    }}