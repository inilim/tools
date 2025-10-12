<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other{function colorHexToAnsi(string $hex):int{$r=\Inilim\Tool\Method\Other\colorHexToRgb($hex);return (int)(16+\round($r['red']/51)*36+\round($r['green']/51)*6+\round($r['blue']/51));}if(!\Inilim\Tool\Other::__definedIfNot('colorHexToRgb')){
    function colorHexToRgb(string $hex):array{$hex=\strtolower(\ltrim($hex,'#'));if(\strlen($hex)===3){$r=\hexdec(\substr($hex,0,1).\substr($hex,0,1));$g=\hexdec(\substr($hex,1,1).\substr($hex,1,1));$b=\hexdec(\substr($hex,2,1).\substr($hex,2,1));}else{$r=\hexdec(\substr($hex,0,2));$g=\hexdec(\substr($hex,2,2));$b=\hexdec(\substr($hex,4,2));}return['red'=>(int) $r,'green'=>(int) $g,'blue'=>(int) $b];}
    }}