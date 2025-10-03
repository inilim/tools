<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other{function resourceContentWriteToTmpFile($resource):?string{return \Inilim\Tool\Method\Other\resourceContentWriteToFile($resource,\Inilim\Tool\Method\Path\normalize(\sys_get_temp_dir().'/inilim-tools-'.\Inilim\Tool\Method\ID\uuidv4().'.tmp'));}if(!\Inilim\Tool\Other::__definedIfNot('__setErrorLast')){
    function __setErrorLast(int $type,string $message,string $file,int $line):void{\Inilim\Tool\Method\Other\__state()-> error=['type'=>$type,'message'=>$message,'file'=>$file,'line'=>$line];}
    }if(!\Inilim\Tool\Other::__definedIfNot('__state')){
    function __state():object{static $o=null;return $o ??= new class{var?array $error=null;};}
    }if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }if(!\Inilim\Tool\Other::__definedIfNot('resourceContentWriteToFile')){
    function resourceContentWriteToFile($resource,string $pathToFile):?string{\Inilim\Tool\Method\Assert\resource($resource);return \Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$resource,$pathToFile){$targetResource=\fopen($pathToFile,'wb');if($targetResource===false){\Inilim\Tool\Method\Other\__setErrorLast(-1,\sprintf('fopen("%s") failed',$pathToFile),'',-1);return null;}$curPos=\ftell($resource);\rewind($resource);while(true){$data=\fread($resource,8192);if($data===false){\Inilim\Tool\Method\Other\__setErrorLast(-1,'fread(arg#0) failed','',-1);break;}if(\fwrite($targetResource,$data)===false){\Inilim\Tool\Method\Other\__setErrorLast(-1,\sprintf('fwrite("%s") failed',$pathToFile),'',-1);break;}if(\feof($resource)){break;}}\fclose($targetResource);\fseek($resource,$curPos);return $pathToFile;},null);}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }}namespace Inilim\Tool\Method\Path{if(!\Inilim\Tool\Path::__definedIfNot('normalize')){
    function normalize(string $path):string{$path=\strtr($path,'\\','/');$path=\Inilim\Tool\Method\Str\deduplicate($path,'/');if(':'===\Inilim\Tool\Method\Str\substr($path,1,1)){$path=\Inilim\Tool\Method\Str\ucfirst($path);}return $path;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('deduplicate')){
    function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('ucfirst')){
    function ucfirst(string $string):string{return \Inilim\Tool\Method\Str\upper(\Inilim\Tool\Method\Str\substr($string,0,1)).\Inilim\Tool\Method\Str\substr($string,1);}
    }if(!\Inilim\Tool\Str::__definedIfNot('upper')){
    function upper(string $value,?string $encoding='UTF-8'):string{return \mb_strtoupper($value,$encoding);}
    }}namespace Inilim\Tool\Method\ID{if(!\Inilim\Tool\ID::__definedIfNot('uuidFromHex')){
    function uuidFromHex(string $uhex,int $version):string{return \sprintf('%08s-%04s-%04x-%04x-%12s',\substr($uhex,0,8),\substr($uhex,8,4),\hexdec(\substr($uhex,12,4))&0xfff|$version << 12,\hexdec(\substr($uhex,16,4))&0x3fff|0x8000,\substr($uhex,20,12));}
    }if(!\Inilim\Tool\ID::__definedIfNot('uuidv4')){
    function uuidv4():string{return \Inilim\Tool\Method\ID\uuidFromHex(\bin2hex(\random_bytes(16)),4);}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('resource')){
    function resource($value,?string $type=null,string $message=''){if($type!==null&&!\Inilim\Tool\Method\Check\resource($value,$type)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a resource of type %2$s. Got: %s',\Inilim\Tool\Method\Other\getType($value),$type));}if(!\Inilim\Tool\Method\Check\resource($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a resource. Got: %s',\Inilim\Tool\Method\Other\getType($value),$type));}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('resource')){
    function resource($value,?string $type=null):bool{if(!\is_resource($value)){return false;}if($type&&$type!==\get_resource_type($value)){return false;}return true;}
    }}