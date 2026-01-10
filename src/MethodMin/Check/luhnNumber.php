<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check{function luhnNumber($value):bool{if(!\Inilim\Tool\Method\Integer\isNumeric($value)){return false;}$value=(string) $value;if(\Inilim\Tool\Method\PF\str_starts_with($value,'-')){return false;}$digits=[];foreach(\str_split($value)as $i){$digits[]=(int) $i;}$sum=0;$numDigits=\count($digits);$parity=$numDigits%2;for($i=0;$i<$numDigits;++$i){$digit=$digits[$i];if($parity==$i%2){$digit <<= 1;if(9<$digit){$digit=$digit-9;}}$sum += $digit;}return $sum%10==0;}if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\Integer{if(!\Inilim\Tool\Integer::__definedIfNot('isNumeric')){
    function isNumeric($v):bool{$t=\gettype($v);if(!\in_array($t,['string','integer'],true)){return false;}if($t==='integer'||\preg_match('#^\-?[1-9][0-9]{0,}$|^0$#',$v)){return true;}return false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_starts_with')){
    function str_starts_with(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }}