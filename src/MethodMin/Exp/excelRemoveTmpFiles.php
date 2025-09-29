<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp{function excelRemoveTmpFiles($pathToFileOrZip):int{\Inilim\Tool\Method\Assert\extPhp('dom');$zip=\Inilim\Tool\Method\Zip\getObjFrom($pathToFileOrZip);$zipPathToFile=\Inilim\Tool\Method\Path\normalize($zip -> filename);unset($zip);$fileInfo=\Inilim\Tool\Method\Path\normalize(\sys_get_temp_dir().'/inilim-tools-excel-'.\md5($zipPathToFile).'.tmp');if(!\Inilim\Tool\Method\FS\isFile($fileInfo)){return 0;}$count=0;\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use($fileInfo,&$count){$aInfo=\Inilim\Tool\Method\File\json($fileInfo);if(!\is_array($aInfo)||!\is_array($aInfo['item']?? null)){$count++;\Inilim\Tool\Method\File\delete($fileInfo);return;}$items=$aInfo['item'];unset($aInfo);$count=0;$files=[];foreach($items as $item){$file=(string) $item['path_to_file']?? '';if(\Inilim\Tool\Method\FS\isFile($file)){$files[]=$file;$count++;}}unset($items,$item,$file);$files[]=$fileInfo;$count++;\Inilim\Tool\Method\File\delete($files);},null);return $count;}}namespace Inilim\Tool\Method\File{if(!\Inilim\Tool\File::__definedIfNot('delete')){
    function delete($paths):bool{$paths=\is_array($paths)?$paths:\func_get_args();$success=true;foreach($paths as $path){try{if(@\unlink($path)){\clearstatcache(false,$path);}else{$success=false;}}catch(\ErrorException $e){$success=false;}}return $success;}
    }if(!\Inilim\Tool\File::__definedIfNot('get')){
    function get(string $pathToFile,int $offset=0,?int $length=null,bool $useIncludePath=false,bool $throw=false,$context=null,?array $contextParams=null):array{$args=['pathToFile'=>$pathToFile,'offset'=>$offset,'length'=>$length,'useIncludePath'=>$useIncludePath,'context'=>$context,'contextParams'=>$contextParams,'result'=>null,'result'=>null,'exception'=>null,'errors'=>null,'http_response_header'=>null];\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$args){if(\is_array($args['context'])){if($args['contextParams']===null){$args['context']=\stream_context_create($args['context']);}else{$args['context']=\stream_context_create($args['context'],$args['contextParams']);}}if($args['length']===null){$args['result']=\file_get_contents($args['pathToFile'],$args['useIncludePath'],$args['context'],$args['offset']);}else{$args['result']=\file_get_contents($args['pathToFile'],$args['useIncludePath'],$args['context'],$args['offset'],$args['length']);}if(isset($http_response_header)){$args['http_response_header']=$http_response_header;}},static function($type,$message,$file,$line)use(&$args){$args['errors']??=[];$args['errors'][]=[$message,$type,$file,$line];});if($args['errors']){$args['exception']=\Inilim\Tool\Method\Obj\getCollectionThrowable('File::get(...)');foreach($args['errors']as $err){[$message,$type,$file,$line]=$err;$args['exception'][]=new \ErrorException($message,$type,$type,$file,$line);}unset($args['errors']);}if($args['result']===false){if($throw&&$args['exception']){throw $args['exception'];}return['result'=>null,'exception'=>$args['exception'],'http_response_header'=>$args['http_response_header']];}return['result'=>$args['result'],'exception'=>$args['exception'],'http_response_header'=>$args['http_response_header']];}
    }if(!\Inilim\Tool\File::__definedIfNot('json')){
    function json(string $pathToFile,int $flags=0,bool $lock=false,bool $throw=false,$default=null){if($lock){$result=\Inilim\Tool\Method\File\sharedGet($pathToFile);}else{$result=\Inilim\Tool\Method\File\get($pathToFile);}if($result['exception']){if($throw){throw $result['exception'];}return $default;}if(!\Inilim\Tool\Method\Check\isJson($result['result'])){if($throw){throw new \JsonException(\sprintf('Content file not json "%s"',$pathToFile));}return $default;}return \json_decode($result['result'],true,512,$flags);}
    }if(!\Inilim\Tool\File::__definedIfNot('sharedGet')){
    function sharedGet(string $pathToFile,bool $throw=false):array{$args=['pathToFile'=>$pathToFile,'result'=>null,'e'=>null,'errors'=>null];\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$args){$handle=\fopen($args['pathToFile'],'rb');if($handle){try{if(\flock($handle,\LOCK_SH)){\clearstatcache(true,$args['pathToFile']);$args['result']=\fread($handle,\filesize($args['pathToFile'])?:1);\flock($handle,\LOCK_UN);}}finally{\fclose($handle);}}},static function($type,$message,$file,$line)use(&$args){$args['errors']??=[];$args['errors'][]=[$message,$type,$file,$line];});if($args['errors']){$args['e']=\Inilim\Tool\Method\Obj\getCollectionThrowable();foreach($args['errors']as $err){$args['e'][]=new \ErrorException($err[0],$err[1],$err[1],$err[2],$err[3]);}unset($args['errors']);}if($args['result']===false||$args['result']===null){if($throw&&$args['e']){throw $args['e'];}return['result'=>null,'exception'=>$args['e']];}return['result'=>$args['result'],'exception'=>$args['e']];}
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
    function __state():object{static $o=null;return $o ??= new class{var?array $error=null;};}
    }if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&!$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
    }if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }}namespace Inilim\Tool\Method\FS{if(!\Inilim\Tool\FS::__definedIfNot('isFile')){
    function isFile(string $filename):bool{$value=\Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn()=>\is_file($filename),null);return $value===null?false:$value;}
    }}namespace Inilim\Tool\Method\Zip{if(!\Inilim\Tool\Zip::__definedIfNot('getObjFrom')){
    function getObjFrom($pathToFileOrZip):\ZipArchive{\Inilim\Tool\Method\Assert\extPhp('zip');$type=\Inilim\Tool\Method\Other\getType($pathToFileOrZip);if($type==='string'){$zip=\Inilim\Tool\Method\Zip\open($pathToFileOrZip);if(!$zip){throw new \InvalidArgumentException(\sprintf('File "%s", not open',$pathToFileOrZip));}}elseif($type==='object'){if(!$pathToFileOrZip instanceof \ZipArchive){throw new \InvalidArgumentException(\sprintf('Expected (arg #0) a string or \ZipArchive. Got: %s',\get_class($pathToFileOrZip)));}$zip=$pathToFileOrZip;if($zip -> filename===''){throw new \InvalidArgumentException('Uninitialized zip');}}else{throw new \InvalidArgumentException(\sprintf('Expected (arg #0) a string or \ZipArchive. Got: %s',$type));}return $zip;}
    }if(!\Inilim\Tool\Zip::__definedIfNot('open')){
    function open(string $filename,int $flags=0):?\ZipArchive{\Inilim\Tool\Method\Assert\extPhp('zip');$_filename=\Inilim\Tool\Method\Path\realPath($filename);if(!$_filename){\Inilim\Tool\Method\Other\__setErrorLast(-1,'file not found',$filename,-1);return null;}$_filename=\Inilim\Tool\Method\Path\normalize($_filename);$zip=new \ZipArchive();$status=\Inilim\Tool\Method\Other\tryCallWithErrHandler(static fn()=>$zip -> open($_filename,$flags),null);if($status!==true){if(\is_int($status)){$errors=[\ZipArchive :: ER_EXISTS=>'File already exists',\ZipArchive :: ER_INCONS=>'Zip archive inconsistent',\ZipArchive :: ER_INVAL=>'Invalid argument',\ZipArchive :: ER_MEMORY=>'Memory allocation failure',\ZipArchive :: ER_NOENT=>'No such file',\ZipArchive :: ER_NOZIP=>'Not a zip archive',\ZipArchive :: ER_OPEN=>'Can\'t open file',\ZipArchive :: ER_READ=>'Read error',\ZipArchive :: ER_SEEK=>'Seek error'];\Inilim\Tool\Method\Other\__setErrorLast(-1,$errors[$status]?? 'zip open failed',$filename,-1);}else{\Inilim\Tool\Method\Other\__setErrorLast(-1,'zip open failed',$filename,-1);}return null;}return $zip;}
    }}namespace Inilim\Tool\Method\Obj{if(!\Inilim\Tool\Obj::__definedIfNot('getCollectionThrowable')){
    function getCollectionThrowable(string $message = '', int $code = 0, ?int $line = null, ?string $file = null, ?\Throwable $previous = null)
{
    return new class($message, $code, $line, $file, $previous) extends \Exception implements \ArrayAccess, \IteratorAggregate, \Countable
    {
        protected $a = [];
        function __construct($message, $code, $line, $file, $previous)
        {
            parent::__construct($message, $code, $previous);
            $this->line = $line ?? -1;
            $this->file = $file ?? '';
        }
        function getIterator(): \Traversable
        {
            return new \ArrayIterator($this->a);
        }
        #[\ReturnTypeWillChange]
        function offsetExists($offset): bool
        {
            return isset($this->a[$offset]);
        }
        #[\ReturnTypeWillChange]
        function offsetGet($offset)
        {
            return $this->a[$offset] ?? null;
        }
        #[\ReturnTypeWillChange]
        function offsetSet($offset, $e)
        {
            if (!$e instanceof \Throwable) {
                throw new \InvalidArgumentException('Value must be of type object<\Throwable>');
            }
            if ($offset === null) {
                $this->a[] = $e;
            } else {
                $this->a[$offset] = $e;
            }
        }
        #[\ReturnTypeWillChange]
        function offsetUnset($offset)
        {
            unset($this->a[$offset]);
        }
        function count(): int
        {
            return \sizeof($this->a);
        }
    };
    return $e;
}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('extPhp')){
    function extPhp(string $nameExt,string $message=''){if(!\Inilim\Tool\Method\Other\extPhp($nameExt)){throw new \InvalidArgumentException(\sprintf($message?:'PHP Extension "%s" not found',$nameExt));}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('isJson')){
    function isJson($value):bool{if(!\is_string($value)){return false;}return \Inilim\Tool\Method\PF\json_validate($value);}
    }if(!\Inilim\Tool\Check::__definedIfNot('php83')){
    function php83():bool{return \PHP_VERSION_ID>=80300?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('json_validate')){
    function json_validate(string $json,int $depth=512,int $flags=0):bool{if(\Inilim\Tool\Method\Check\php83()){return \json_validate($json,$depth,$flags);}if(0!==$flags&&\defined('JSON_INVALID_UTF8_IGNORE')&&\JSON_INVALID_UTF8_IGNORE!==$flags){throw new \Error('PF::json_validate(): Argument #3 ($flags) must be a valid flag (allowed flags: JSON_INVALID_UTF8_IGNORE)');}if($depth<=0){throw new \Error('PF::json_validate(): Argument #2 ($depth) must be greater than 0');}$json_max_depth=0x7fffffff;if($depth>$json_max_depth){throw new \Error(\sprintf('PF::json_validate(): Argument #2 ($depth) must be less than %d',$json_max_depth));}\json_decode($json,null,$depth,$flags);return \JSON_ERROR_NONE===\json_last_error();}
    }}