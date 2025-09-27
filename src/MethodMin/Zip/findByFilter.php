<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip{function findByFilter($pathToFileOrZip,callable $predicate,$valueBreak=null):array{return \iterator_to_array(\Inilim\Tool\Method\Zip\findByFilterAsGenerator($pathToFileOrZip,$predicate,$valueBreak),false);}if(!\Inilim\Tool\Zip::__definedIfNot('findByFilterAsGenerator')){
    function findByFilterAsGenerator($pathToFileOrZip,callable $predicate,$valueBreak=null):\Generator{foreach(\Inilim\Tool\Method\Zip\scanAsGenerator($pathToFileOrZip)as $fileItem){$v=$predicate($fileItem);if($v===$valueBreak){return;}if($v){yield $fileItem;}}}
    }if(!\Inilim\Tool\Zip::__definedIfNot('getObjFrom')){
    function getObjFrom($pathToFileOrZip):\ZipArchive{\Inilim\Tool\Method\Assert\extPhp('zip');$type=\Inilim\Tool\Method\Other\getType($pathToFileOrZip);if($type==='string'){$zip=\Inilim\Tool\Method\Zip\open($pathToFileOrZip);if(!$zip){throw new \InvalidArgumentException(\sprintf('File "%s", not open',$pathToFileOrZip));}}elseif($type==='object'){if(!$pathToFileOrZip instanceof \ZipArchive){throw new \InvalidArgumentException(\sprintf('Expected $pathToFileOrZip a string or \ZipArchive. Got: %s',\get_class($pathToFileOrZip)));}$zip=$pathToFileOrZip;if($zip -> filename===''){throw new \InvalidArgumentException('Uninitialized zip');}}else{throw new \InvalidArgumentException(\sprintf('Expected $pathToFileOrZip a string or \ZipArchive. Got: %s',$type));}return $zip;}
    }if(!\Inilim\Tool\Zip::__definedIfNot('open')){
    function open(string $filename,int $flags=0):?\ZipArchive{\Inilim\Tool\Method\Assert\extPhp('zip');$_filename=\Inilim\Tool\Method\Path\realPath($filename);if(!$_filename){\Inilim\Tool\Method\Other\__setErrorLast(-1,'file not found',$filename,-1);return null;}$_filename=\Inilim\Tool\Method\Path\normalize($_filename);$zip=new \ZipArchive();$status=\Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn()=>$zip -> open($_filename,$flags),null);if($status!==true){if(\is_int($status)){$errors=[\ZipArchive :: ER_EXISTS=>'File already exists',\ZipArchive :: ER_INCONS=>'Zip archive inconsistent',\ZipArchive :: ER_INVAL=>'Invalid argument',\ZipArchive :: ER_MEMORY=>'Memory allocation failure',\ZipArchive :: ER_NOENT=>'No such file',\ZipArchive :: ER_NOZIP=>'Not a zip archive',\ZipArchive :: ER_OPEN=>'Can\'t open file',\ZipArchive :: ER_READ=>'Read error',\ZipArchive :: ER_SEEK=>'Seek error'];\Inilim\Tool\Method\Other\__setErrorLast(-1,$errors[$status]?? 'zip open failed',$filename,-1);}else{\Inilim\Tool\Method\Other\__setErrorLast(-1,'zip open failed',$filename,-1);}return null;}return $zip;}
    }if(!\Inilim\Tool\Zip::__definedIfNot('scanAsGenerator')){
    function scanAsGenerator($pathToFileOrZip):\Generator{\Inilim\Tool\Method\Assert\extPhp('zip');$zip=\Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);for($i=0;$i<$zip -> numFiles;$i++){$ri=$zip -> statIndex($i);if($ri===false){continue;}yield $ri;}}
    }}namespace Inilim\Tool\Method\Path{if(!\Inilim\Tool\Path::__definedIfNot('normalize')){
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
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('__setErrorLast')){
    function __setErrorLast(int $type,string $message,string $file,int $line):void{\Inilim\Tool\Method\Other\__state()-> error=['type'=>$type,'message'=>$message,'file'=>$file,'line'=>$line];}
    }if(!\Inilim\Tool\Other::__definedIfNot('__state')){
    function __state():object{static $o=null;return $o ?? new class{var?array $error=null;};}
    }if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&!$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
    }if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('extPhp')){
    function extPhp(string $nameExt,string $message=''){if(!\Inilim\Tool\Method\Other\extPhp($nameExt)){throw new \InvalidArgumentException(\sprintf($message?:'PHP Extension "%s" not found',$nameExt));}}
    }}