<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str;

function fullwidthToHalfwidth(string $str):string{return \strtr($str,['０'=>'0','１'=>'1','２'=>'2','３'=>'3','４'=>'4','５'=>'5','６'=>'6','７'=>'7','８'=>'8','９'=>'9']);}