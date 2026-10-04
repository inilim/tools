<?php

namespace Inilim\Tool\Method\Obj{function iteratorFilesRecursive(string $pathToDir,bool $skipDots=true){$dir=\Inilim\Tool\Method\Path\realPath($pathToDir);if($dir===null||!\is_dir($dir)){throw new \InvalidArgumentException(\sprintf('Not found dir "%s"',$pathToDir));}$dir=\Inilim\Tool\Method\Path\normalize($dir);$flags=\FilesystemIterator :: KEY_AS_FILENAME|\FilesystemIterator :: CURRENT_AS_FILEINFO|\FilesystemIterator :: UNIX_PATHS;if($skipDots){$flags |= \FilesystemIterator :: SKIP_DOTS;}$rdi=new \RecursiveDirectoryIterator($dir,$flags);return new \RecursiveIteratorIterator($rdi,\RecursiveIteratorIterator :: SELF_FIRST);}}namespace Inilim\Tool\Method\Path{if(!\Inilim\Tool\Path::__definedIfNot('normalize')){
    function normalize(string $path):string{$path=\strtr($path,'\\','/');$path=\Inilim\Tool\Method\Str\deduplicate($path,'/');if(':'===\Inilim\Tool\Method\LarStr\substr($path,1,1)){$path=\Inilim\Tool\Method\LarStr\ucfirst($path);}return $path;}
    }if(!\Inilim\Tool\Path::__definedIfNot('realPath')){
    function realPath(string $path):?string{$value=\Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn()=>\realpath($path),null);return $value===false?null:$value;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('deduplicate')){
    function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }}namespace Inilim\Tool\Method\LarStr{if(!\Inilim\Tool\LarStr::__definedIfNot('substr')){
    function substr($string,$start,$length=null,$encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('ucfirst')){
    function ucfirst($string){return \Inilim\Tool\Method\LarStr\upper(\Inilim\Tool\Method\LarStr\substr($string,0,1)).\Inilim\Tool\Method\LarStr\substr($string,1);}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('upper')){
    function upper($value){return \mb_strtoupper($value,'UTF-8');}
    }}