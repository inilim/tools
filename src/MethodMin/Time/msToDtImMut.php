<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Time{function msToDtImMut(int $ms,?\DateTimeZone $timezone=null):\DateTimeImmutable{return \DateTimeImmutable :: createFromMutable(\Inilim\Tool\Method\Time\msToDt($ms,$timezone));}if(!\Inilim\Tool\Time::__definedIfNot('msToDt')){
    function msToDt(int $ms,?\DateTimeZone $timezone=null):\DateTime{$t=\sprintf('%1.6F',$ms/1000);return \DateTime :: createFromFormat('U.u',$t,$timezone ?? new \DateTimeZone('UTC'));}
    }}