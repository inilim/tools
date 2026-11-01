<?php

namespace Inilim\Tool\Method\Obj{function iteratorFilesRecursive(string $pathToDir,bool $skipDots=true){$dir=\Inilim\Tool\Method\Path\realPath($pathToDir);if(null===$dir||!\Inilim\Tool\Method\FS\isDir($dir)){throw new \InvalidArgumentException(\sprintf('Not found dir "%s"',$pathToDir));}$dir=\Inilim\Tool\Method\Path\normalize($dir);$flags=\FilesystemIterator :: KEY_AS_FILENAME|\FilesystemIterator :: CURRENT_AS_FILEINFO|\FilesystemIterator :: UNIX_PATHS;if($skipDots){$flags |= \FilesystemIterator :: SKIP_DOTS;}$rdi=new \RecursiveDirectoryIterator($dir,$flags);return new \RecursiveIteratorIterator($rdi,\RecursiveIteratorIterator :: SELF_FIRST);}}namespace Inilim\Tool\Method\Path{if(!\Inilim\Tool\Path::__definedIfNot('normalize')){
    function normalize(string $path):string{$path=\strtr($path,'\\','/');$path=\Inilim\Tool\Method\Str\deduplicate($path,'/');if(':'===\Inilim\Tool\Method\LarStr\substr($path,1,1)){$path=\Inilim\Tool\Method\LarStr\ucfirst($path);}return $path;}
    }if(!\Inilim\Tool\Path::__definedIfNot('realPath')){
    function realPath(string $path):?string{$value=\Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn()=>\realpath($path),null);return \is_string($value)?$value:null;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('deduplicate')){
    function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if(null===$use['handler']){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler_m2')){
    function tryCallWithErrHandler_m2(callable $callable,?callable $handler=null,int $errorLevels=\E_ALL){if(null===$handler){$handler=static function($levelOrCode,string $message,string $file,int $line){\Inilim\Tool\Method\Other\__setErrorLast((int) $levelOrCode,$message,$file,$line);};}return \Inilim\Tool\Method\Other\tryCallWithErrHandler($callable,$handler,$errorLevels);}
    }if(!\Inilim\Tool\Other::__definedIfNot('__setErrorLast')){
    function __setErrorLast(int $type,string $message,string $file,int $line):void{\Inilim\Tool\Method\Other\__state()-> error=['type'=>$type,'message'=>$message,'file'=>$file,'line'=>$line];}
    }if(!\Inilim\Tool\Other::__definedIfNot('__state')){
    function __state():object{static $o=null;return $o ??= new class{var?array $error=null;};}
    }}namespace Inilim\Tool\Method\FS{if(!\Inilim\Tool\FS::__definedIfNot('isDir')){
    function isDir(string $filename):bool{$value=\Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function()use($filename){\clearstatcache(false,$filename);$t=\is_dir($filename);return null===$t?false:$t;});return \is_bool($value)?$value:false;}
    }}namespace Inilim\Tool\Method\LarStr{if(!\Inilim\Tool\LarStr::__definedIfNot('substr')){
    function substr($string,$start,$length=null,$encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('ucfirst')){
    function ucfirst($string){return \mb_ucfirst($string,'UTF-8');}
    }}