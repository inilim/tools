<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Time;

function msToDt(int $ms,?\DateTimeZone $timezone=null):\DateTime{$t=\sprintf('%1.6F',$ms/1000);return \DateTime :: createFromFormat('U.u',$t,$timezone ?? new \DateTimeZone('UTC'));}