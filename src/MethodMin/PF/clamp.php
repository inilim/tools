<?php

declare(strict_types=1);namespace Inilim\Tool\Method\PF{function clamp($value,$min,$max){if(\Inilim\Tool\Method\Check\php86()){return \clamp($value,$min,$max);}if(\is_float($min)&&\is_nan($min)){\Inilim\Tool\Method\Other\throwValueErrorIfAvailable(\Inilim\Tool\PF :: class.'::clamp(): Argument #2 ($min) must not be NAN');}if(\is_float($max)&&\is_nan($max)){\Inilim\Tool\Method\Other\throwValueErrorIfAvailable(\Inilim\Tool\PF :: class.'::clamp(): Argument #3 ($max) must not be NAN');}if($max<$min){\Inilim\Tool\Method\Other\throwValueErrorIfAvailable(\Inilim\Tool\PF :: class.'::clamp(): Argument #2 ($min) must be smaller than or equal to argument #3 ($max)');}if($value>$max){return $max;}if($value<$min){return $min;}return $value;}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('classPhp')){
    function classPhp(string $class,bool $rechecking=false,bool $autoload=true):bool{static $o=null;$o ??=[];if(isset($o[$class])&&!$rechecking){return $o[$class];}return $o[$class]=\class_exists($class,$autoload);}
    }if(!\Inilim\Tool\Other::__definedIfNot('throwValueErrorIfAvailable')){
    function throwValueErrorIfAvailable($message='',$code=0,?\Throwable $previous=null):void{if(!\Inilim\Tool\Method\Other\classPhp(\ValueError :: class)){throw new \InvalidArgumentException($message,$code,$previous);}throw new \ValueError($message,$code,$previous);}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php86')){
    function php86():bool{return \PHP_VERSION_ID>=80600?true:false;}
    }}