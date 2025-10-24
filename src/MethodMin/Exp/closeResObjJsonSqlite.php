<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Exp{function closeResObjJsonSqlite(object $value):bool{if(!\Inilim\Tool\Method\Exp\isResObjJsonSqlite($value)){return false;}return \Inilim\Tool\Method\Other\bindAndCall($value,function(){if($this -> tag===''){return false;}$this -> tag='';$this -> pdo=null;return \Inilim\Tool\Method\FS\unlink($this -> tmpFile);});}if(!\Inilim\Tool\Exp::__definedIfNot('__tagJsonSqlite')){
    function __tagJsonSqlite():string{return 'open-file-json-sqlite';}
    }if(!\Inilim\Tool\Exp::__definedIfNot('isResObjJsonSqlite')){
    function isResObjJsonSqlite($value):bool{if(!\is_object($value)||!\Inilim\Tool\Method\PF\str_starts_with(\get_class($value),'class@anonymous')){return false;}return \Inilim\Tool\Method\Other\bindAndCall($value,function(){return($this -> tag ?? '')===\Inilim\Tool\Method\Exp\__tagJsonSqlite();});}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('__setErrorLast')){
    function __setErrorLast(int $type,string $message,string $file,int $line):void{\Inilim\Tool\Method\Other\__state()-> error=['type'=>$type,'message'=>$message,'file'=>$file,'line'=>$line];}
    }if(!\Inilim\Tool\Other::__definedIfNot('__state')){
    function __state():object{static $o=null;return $o ??= new class{var?array $error=null;};}
    }if(!\Inilim\Tool\Other::__definedIfNot('bindAndCall')){
    function bindAndCall(object $object,\Closure $callback,... $args){$result=$callback -> bindTo($object,$object)-> __invoke(... $args);\Inilim\Tool\Method\Other\clearClosure($callback);return $result;}
    }if(!\Inilim\Tool\Other::__definedIfNot('clearClosure')){
    function clearClosure(\Closure $cls):?\Closure{return \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static fn()=>$cls -> bindTo(null,null));}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler_m2')){
    function tryCallWithErrHandler_m2(callable $callable,?callable $handler=null,int $errorLevels=\E_ALL){if($handler===null){$handler=static function($levelOrCode,$message,$file,$line){\Inilim\Tool\Method\Other\__setErrorLast($levelOrCode,$message,$file,$line);};}return \Inilim\Tool\Method\Other\tryCallWithErrHandler($callable,$handler,$errorLevels);}
    }}namespace Inilim\Tool\Method\FS{if(!\Inilim\Tool\FS::__definedIfNot('unlink')){
    function unlink(string $filename,$context=null):bool{$value=\Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function()use($filename,$context){$result=$context?\unlink($filename,$context):\unlink($filename);if($result){\clearstatcache(false,$filename);return true;}return false;});return $value===null?false:$value;}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_starts_with')){
    function str_starts_with(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }}