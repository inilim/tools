<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Path{function getProjectDirUsingComposer():?string{$dir=\Inilim\Tool\Method\Path\getVendorDirUsingComposer();return $dir?\dirname($dir,1):null;}if(!\Inilim\Tool\Path::__definedIfNot('getVendorDirUsingComposer')){
    function getVendorDirUsingComposer():?string{static $cacheDir=null;if($cacheDir!==null){return $cacheDir;}if(\is_array($result=\Inilim\Tool\Method\Other\composerRootPackage())&&\is_string($result=$result['install_path']?? null)&&\is_string($result=\Inilim\Tool\Method\Path\realPath($result))){return $cacheDir=\Inilim\Tool\Method\Path\normalize($result.'/vendor');}return null;}
    }if(!\Inilim\Tool\Path::__definedIfNot('normalize')){
    function normalize(string $path):string{$path=\strtr($path,'\\','/');$path=\Inilim\Tool\Method\Str\deduplicate($path,'/');if(':'===\Inilim\Tool\Method\Str\substr($path,1,1)){$path=\Inilim\Tool\Method\Str\ucfirst($path);}return $path;}
    }if(!\Inilim\Tool\Path::__definedIfNot('realPath')){
    function realPath(string $path):?string{$value=\Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn()=>\realpath($path),null);return $value===false?null:$value;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('deduplicate')){
    function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('ucfirst')){
    function ucfirst(string $string):string{return \Inilim\Tool\Method\Str\upper(\Inilim\Tool\Method\Str\substr($string,0,1)).\Inilim\Tool\Method\Str\substr($string,1);}
    }if(!\Inilim\Tool\Str::__definedIfNot('upper')){
    function upper(string $value,?string $encoding='UTF-8'):string{return \mb_strtoupper($value,$encoding);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('composerRootPackage')){
    function composerRootPackage():?array{if(\class_exists($class=\Composer\InstalledVersions :: class,true)&&\is_callable($callable=[$class,'getRootPackage'])){$value=\Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn()=>$callable(),null);if(!\is_array($value)){return null;}return $value;}return null;}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }}