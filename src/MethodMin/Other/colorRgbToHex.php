<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function colorRgbToHex(int $red,int $green,int $blue,bool $withGrid=false):string{$r=\max(0,\min(255,$red));$g=\max(0,\min(255,$green));$b=\max(0,\min(255,$blue));return \sprintf('%s%X%X%X',$withGrid?'#':'',$r,$g,$b);}