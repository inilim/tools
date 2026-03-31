<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Data{function arabicAlphabetAsClosure(){\Inilim\Tool\Method\Assert\extPhp('mbstring');return static function(){$result=[];foreach([1571,1576,1578,1579,1580,1581,1582,1583,1584,1585,1586,1587,1588,1589,1590,1591,1592,1593,1594,1601,1602,1603,1604,1605,1606,1607,1600,1608,1610]as $code){$result[]=\mb_chr($code,'UTF-8');}return $result;};}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&!$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('extPhp')){
    function extPhp(string $nameExt,string $message=''){if(!\Inilim\Tool\Method\Other\extPhp($nameExt)){throw new \InvalidArgumentException(\sprintf($message?:'PHP Extension "%s" not found',$nameExt));}}
    }}