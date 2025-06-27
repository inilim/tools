<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj{function sprintfException(string $format,array $values,$classOrObj=\Exception :: class,array $args=[]):\Throwable{$message=\sprintf($format,... $values);if(\is_object($classOrObj)){$class=\get_class($classOrObj);return \Inilim\Tool\Method\Obj\rewriteLocationException(new $class($message,... $args),$classOrObj -> getFile(),$classOrObj -> getLine());}else{return new $classOrObj($message,... $args);}}if(!\Inilim\Tool\Obj::__definedIfNot('rewriteLocationException')){
    function rewriteLocationException(\Throwable $e,string $file,int $line):object{$rc=new \ReflectionClass($e);$rpf=$rc -> getProperty('file');$rpl=$rc -> getProperty('line');$rpf -> setAccessible(true);$rpl -> setAccessible(true);$rpf -> setValue($e,$file);$rpl -> setValue($e,$line);return $e;}
    }}