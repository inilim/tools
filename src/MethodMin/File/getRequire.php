<?php

declare(strict_types=1);namespace Inilim\Tool\Method\File{function getRequire(string $pathToFile,array $data=[],bool $once=false){if(\is_file($pathToFile)){$__path=$pathToFile;$__data=$data;$__once=$once;return(static function()use($__path,$__data,$__once){\extract($__data,\EXTR_SKIP);if($__once){return require_once $__path;}return require $__path;})();}throw \Inilim\Tool\Method\Obj\sprintfException('File does not exist at path "%s".',[$pathToFile]);}}namespace Inilim\Tool\Method\Obj{if(!\Inilim\Tool\Obj::__definedIfNot('rewriteLocationException')){
    function rewriteLocationException(\Throwable $e,string $file,int $line):object{$rc=new \ReflectionClass($e);$rpf=$rc -> getProperty('file');$rpl=$rc -> getProperty('line');if(!\Inilim\Tool\Method\Check\php81()){$rpf -> setAccessible(true);$rpl -> setAccessible(true);}$rpf -> setValue($e,$file);$rpl -> setValue($e,$line);return $e;}
    }if(!\Inilim\Tool\Obj::__definedIfNot('sprintfException')){
    function sprintfException(string $format='',array $values=[],$classOrObj=\Exception :: class,array $args=[]):\Throwable{$message=\sprintf($format,... $values);if(\is_object($classOrObj)){$class=\get_class($classOrObj);return \Inilim\Tool\Method\Obj\rewriteLocationException(new $class($message,... $args),$classOrObj -> getFile(),$classOrObj -> getLine());}else{return new $classOrObj($message,... $args);}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php81')){
    function php81():bool{return \PHP_VERSION_ID>=80100?true:false;}
    }}