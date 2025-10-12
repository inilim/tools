<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Time{function weeksMs(int $weeks):int{return \Inilim\Tool\Method\Time\weeksSec($weeks)*1000;}if(!\Inilim\Tool\Time::__definedIfNot('weeksSec')){
    function weeksSec(int $weeks):int{return 604800*$weeks;}
    }}