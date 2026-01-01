<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Exp{function jsonExtractViaSqlite(string $json,$pattern){\Inilim\Tool\Method\Assert\extPhp('PDO');\Inilim\Tool\Method\Assert\extPhp('pdo_sqlite');\Inilim\Tool\Method\Assert\strOrArr($pattern);if(!\is_array($pattern)){$pattern=[$pattern];}\Inilim\Tool\Method\Assert\allString($pattern);$internal=static function()use($json,$pattern){$params=['json'=>&$json];unset($json);$list=[];$idx=0;foreach($pattern as $item){$placeholder=':_'.$idx++;$params[$placeholder]=$item;$list[]=$placeholder;}$list=\implode(',',$list);$pdo=new \PDO('sqlite::memory:',null,null,[\PDO :: ATTR_ERRMODE=>\PDO :: ERRMODE_EXCEPTION]);$stmt=$pdo -> prepare(\sprintf('SELECT json_extract(:json, %s) as v',$list));unset($list);$stmt -> execute($params);unset($params);$result=$stmt -> fetch(\PDO :: FETCH_NUM);$pdo=$stmt=null;return $result[0]?? null;};return \Inilim\Tool\Method\Other\tryCallWithErrHandler_m2($internal);}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('__setErrorLast')){
    function __setErrorLast(int $type,string $message,string $file,int $line):void{\Inilim\Tool\Method\Other\__state()-> error=['type'=>$type,'message'=>$message,'file'=>$file,'line'=>$line];}
    }if(!\Inilim\Tool\Other::__definedIfNot('__state')){
    function __state():object{static $o=null;return $o ??= new class{var?array $error=null;};}
    }if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&!$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
    }if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler_m2')){
    function tryCallWithErrHandler_m2(callable $callable,?callable $handler=null,int $errorLevels=\E_ALL){if($handler===null){$handler=static function($levelOrCode,string $message,string $file,int $line){\Inilim\Tool\Method\Other\__setErrorLast((int) $levelOrCode,$message,$file,$line);};}return \Inilim\Tool\Method\Other\tryCallWithErrHandler($callable,$handler,$errorLevels);}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('allString')){
    function allString($value,string $message=''){\Inilim\Tool\Method\Assert\isIterable($value);foreach($value as $entry){\Inilim\Tool\Method\Assert\string($entry,$message);}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('extPhp')){
    function extPhp(string $nameExt,string $message=''){if(!\Inilim\Tool\Method\Other\extPhp($nameExt)){throw new \InvalidArgumentException(\sprintf($message?:'PHP Extension "%s" not found',$nameExt));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('isIterable')){
    function isIterable($value,string $message=''){if(!\Inilim\Tool\Method\Check\isIterable($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected an iterable. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('strOrArr')){
    function strOrArr($value,string $message=''){if(!\Inilim\Tool\Method\Check\strOrArr($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a string or array. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('string')){
    function string($value,string $message=''){if(!\is_string($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a string. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('isIterable')){
    function isIterable($value):bool{return \is_array($value)||$value instanceof \Traversable;}
    }if(!\Inilim\Tool\Check::__definedIfNot('strOrArr')){
    function strOrArr($value):bool{return \is_string($value)||\is_array($value);}
    }}