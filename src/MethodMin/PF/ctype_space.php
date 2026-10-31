<?php

declare(strict_types=1);namespace Inilim\Tool\Method\PF{function ctype_space($text):bool{if(\Inilim\Tool\Method\Other\funcPhp('ctype_space')){return \ctype_space($text);}$cls=\Inilim\Tool\Method\Other\__resourceCache(__FUNCTION__,'convert_int_to_char_for_ctype');$text=$cls -> __invoke($text,'ctype_space');return \is_string($text)&&''!==$text&&!\preg_match('/[^\s]/',$text);}if(!\Inilim\Tool\PF::__definedIfNot('array_first')){
    function array_first(array $array){if(\Inilim\Tool\Method\Check\php85()){return \array_first($array);}foreach($array as $value){return $value;}return null;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('funcPhp')){
    function funcPhp(string $function,bool $rechecking=false):bool{static $o=null;$o ??=[];$function=\ltrim($function,'\\');if(isset($o[$function])&&!$rechecking){return $o[$function];}return $o[$function]=\function_exists($function);}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if(null===$use['handler']){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler_m2')){
    function tryCallWithErrHandler_m2(callable $callable,?callable $handler=null,int $errorLevels=\E_ALL){if(null===$handler){$handler=static function($levelOrCode,string $message,string $file,int $line){\Inilim\Tool\Method\Other\__setErrorLast((int) $levelOrCode,$message,$file,$line);};}return \Inilim\Tool\Method\Other\tryCallWithErrHandler($callable,$handler,$errorLevels);}
    }if(!\Inilim\Tool\Other::__definedIfNot('__resource')){
    function __resource(string $namespace,string $name){$class=\basename(\dirname(\strtr($namespace,'\\','/')));$name=\sprintf('%s/../../../files/resources/%s/%s.php',__DIR__,$class,$name);if(\Inilim\Tool\Method\FS\isFile($name)){return require $name;}return null;}
    }if(!\Inilim\Tool\Other::__definedIfNot('__resourceCache')){
    function __resourceCache(string $namespace,string $name){static $o=null;$o ??=[];$class=\basename(\dirname(\strtr($namespace,'\\','/')));$o[$class]??=[];if(\array_key_exists($name,$o[$class])){return $o[$class][$name];}return $o[$class][$name]=\Inilim\Tool\Method\Other\__resource($namespace,$name);}
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
    }}