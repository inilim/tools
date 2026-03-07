<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Obj{function rewriteLocationException(\Throwable $e,string $file,int $line):object{$rc=new \ReflectionClass($e);$rpf=$rc -> getProperty('file');$rpl=$rc -> getProperty('line');if(!\Inilim\Tool\Method\Check\php81()){$rpf -> setAccessible(true);$rpl -> setAccessible(true);}$rpf -> setValue($e,$file);$rpl -> setValue($e,$line);return $e;}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }}