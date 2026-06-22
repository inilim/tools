<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Time{function secToDtImMut(int $sec,?\DateTimeZone $timezone=null):\DateTimeImmutable{return \DateTimeImmutable :: createFromMutable(\Inilim\Tool\Method\Time\secToDt($sec,$timezone));}if(!\Inilim\Tool\Time::__definedIfNot('secToDt')){
    function secToDt(int $sec,?\DateTimeZone $timezone=null):\DateTime{return new \DateTime("@{$sec}",$timezone ?? new \DateTimeZone('UTC'));}
    }}