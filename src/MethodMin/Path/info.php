<?php

namespace Inilim\Tool\Method\Path{function info(string $pathTo,bool $throw=true){$t=\Inilim\Tool\Method\Path\realPath($pathTo);if(null===$t){if($throw){throw new \Exception(\sprintf('"%s" not found',$pathTo));}return null;}$t=\Inilim\Tool\Method\Path\normalize($t);$pathTo=$t;$t=\pathinfo($t,\PATHINFO_ALL);$t['extension']??= '';return['pathDir'=>$t['dirname'],'nameDir'=>\basename($t['dirname']),'isFile'=>$isFile=\Inilim\Tool\Method\FS\isFile($pathTo),'isDir'=>!$isFile,'isLink'=>\is_link($pathTo),'ext'=>$t['extension'],'withoutExt'=>$t['extension']==='','name'=>$t['filename'],'emptyName'=>$t['filename']==='','fullName'=>$t['basename'],'fullPathTo'=>$pathTo];}if(!\Inilim\Tool\Path::__definedIfNot('normalize')){
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
    }}namespace Inilim\Tool\Method\FS{if(!\Inilim\Tool\FS::__definedIfNot('isFile')){
    function isFile(string $filename):bool{$value=\Inilim\Tool\Method\FS\isFile_m2([$filename]);return \Inilim\Tool\Method\PF\array_first($value);}
    }if(!\Inilim\Tool\FS::__definedIfNot('isFile_m2')){
    function isFile_m2($filenames):array{\is_string($filenames)&&$filenames=[$filenames];$value=\Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function()use(&$filenames){$results=[];foreach($filenames as $filename){\clearstatcache(false,$filename);$t=\is_file($filename);$results[$filename]=null===$t?false:$t;}return $results;});return \is_array($value)?$value:[];}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php85')){
    function php85():bool{return \PHP_VERSION_ID>=80500?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_first')){
    function array_first(array $array){if(\Inilim\Tool\Method\Check\php85()){return \array_first($array);}foreach($array as $value){return $value;}return null;}
    }}namespace Inilim\Tool\Method\LarStr{if(!\Inilim\Tool\LarStr::__definedIfNot('substr')){
    function substr($string,$start,$length=null,$encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('ucfirst')){
    function ucfirst($string){return \mb_ucfirst($string,'UTF-8');}
    }}