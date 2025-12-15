<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other{function throwValueErrorIfAvailable($message='',$code=0,\Throwable $previous=null):void{if(!\Inilim\Tool\Method\Other\classPhp(\ValueError :: class)){throw new \InvalidArgumentException($message,$code,$previous);}throw new \ValueError($message,$code,$previous);}if(!\Inilim\Tool\Other::__definedIfNot('classPhp')){
    function classPhp(string $class,bool $rechecking=false,bool $autoload=true):bool{static $o=null;$o ??=[];if(isset($o[$class])&&!$rechecking){return $o[$class];}return $o[$class]=\class_exists($class,$autoload);}
    }}