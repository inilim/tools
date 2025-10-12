<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function colorHexToRgb(string $hex):array{$hex=\strtolower(\ltrim($hex,'#'));if(\strlen($hex)===3){$r=\hexdec(\substr($hex,0,1).\substr($hex,0,1));$g=\hexdec(\substr($hex,1,1).\substr($hex,1,1));$b=\hexdec(\substr($hex,2,1).\substr($hex,2,1));}else{$r=\hexdec(\substr($hex,0,2));$g=\hexdec(\substr($hex,2,2));$b=\hexdec(\substr($hex,4,2));}return['red'=>(int) $r,'green'=>(int) $g,'blue'=>(int) $b];}