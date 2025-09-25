<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

function colorRgbToHex(int $red,int $green,int $blue,bool $withGrid=false):string{$r=\max(0,\min(255,$red));$g=\max(0,\min(255,$green));$b=\max(0,\min(255,$blue));$hexR=\dechex($r);$hexG=\dechex($g);$hexB=\dechex($b);$hexR=\str_pad($hexR,2,'0',\STR_PAD_LEFT);$hexG=\str_pad($hexG,2,'0',\STR_PAD_LEFT);$hexB=\str_pad($hexB,2,'0',\STR_PAD_LEFT);return($withGrid?'#':'').$hexR.$hexG.$hexB;}