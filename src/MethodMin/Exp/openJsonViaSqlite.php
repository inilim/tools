<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Exp{function openJsonViaSqlite($source):?object{$type=\gettype($source);if($type==='string'){\Inilim\Tool\Method\Assert\file($source);}elseif($type==='resource'){$source=\Inilim\Tool\Method\Other\getPathFromResource($source);if($source===null||$source==='php://temp'){throw new \InvalidArgumentException('$source failed get path to file from resource');}}else{throw new \InvalidArgumentException('$source allow file or open resource');}$class=__FUNCTION__;$internal=static function($obj)use($source,$class){$obj -> pathToFile=\Inilim\Tool\Method\Path\normalize($source);$obj -> hashPathToFile=\md5($obj -> pathToFile);try{$gen=\Inilim\Tool\Method\File\toCharsGenerator($source,4024);}catch(\Exception $e){\Inilim\Tool\Method\Other\__setErrorLast(-1,$e -> getMessage(),'',-1);return null;}$obj -> tmpFile=\sys_get_temp_dir().'/inilim-tools-'.$obj -> hashPathToFile.'.tmp';['exception'=>$e]=\Inilim\Tool\Method\File\put($obj -> tmpFile,\base64_decode(\Inilim\Tool\Method\Other\__resource($class,'db_for_json_file_sqlite'),true));if($e){return null;}$obj -> pdo=new \PDO('sqlite:'.$obj -> tmpFile,null,null,[\PDO :: ATTR_ERRMODE=>\PDO :: ERRMODE_EXCEPTION]);$res=\Inilim\Tool\Method\Other\timedMsCall(static function()use($gen,$obj){foreach($gen as $text){$obj -> stmt=$obj -> pdo -> prepare('UPDATE _table SET _value = _value || :_value WHERE _name = "json"');$obj -> stmt -> execute(['_value'=>$text]);}});unset($gen,$text);$obj -> stmt=$obj -> pdo -> query('SELECT json_valid(_value) as valid FROM _table WHERE _name = "json"');$results=$obj -> stmt -> fetch(\PDO :: FETCH_NUM);if(!isset($results[0])||$results[0]==0){\Inilim\Tool\Method\Other\__setErrorLast(-1,'JSON invalid','',-1);$obj -> pdo=$obj -> stmt=null;\Inilim\Tool\Method\FS\unlink($obj -> tmpFile);return null;}return $obj;};$result=\Inilim\Tool\Method\Other\tryCallWithErrHandler($internal,static function($_,$msg,$_1,$_2,$context){\Inilim\Tool\Method\Other\__setErrorLast(-1,$msg,'',-1);if($context['isException']){$obj=$context['obj'];$obj -> pdo=$obj -> stmt=null;\Inilim\Tool\Method\FS\unlink($obj -> tmpFile);}});if(!\is_object($result)){return null;}$object=new class{protected $tag;protected string $tmpFile;protected string $jsonFile;protected string $hashJsonFile;protected?\PDO $pdo;};\Inilim\Tool\Method\Other\bindAndCall($object,function($result){$this -> tag=\Inilim\Tool\Method\Exp\__tagJsonSqlite();$this -> tmpFile=$result -> tmpFile;$this -> jsonFile=$result -> pathToFile;$this -> hashJsonFile=$result -> hashPathToFile;$this -> pdo=$result -> pdo;},$result);return $object;}if(!\Inilim\Tool\Exp::__definedIfNot('__tagJsonSqlite')){
    function __tagJsonSqlite():string{return 'open-file-json-sqlite';}
    }}namespace Inilim\Tool\Method\File{if(!\Inilim\Tool\File::__definedIfNot('phpfclose')){
    function phpfclose($stream):bool{$result=\Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static fn()=>\fclose($stream));return $result===null?false:$result;}
    }if(!\Inilim\Tool\File::__definedIfNot('phpfopen')){
    function phpfopen(string $filename,string $mode,bool $use_include_path=false,$context=null){$result=\Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static fn()=>\fopen($filename,$mode,$use_include_path,$context));return $result===null?false:$result;}
    }if(!\Inilim\Tool\File::__definedIfNot('put')){
    function put(string $filename,$data,int $flags=0,bool $throw=false,$context=null,?array $contextParams=null):array{$args=['filename'=>$filename,'data'=>$data,'flags'=>$flags,'context'=>$context,'contextParams'=>$contextParams,'result'=>null,'exception'=>null,'errors'=>null];\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$args){if(\is_array($args['context'])){if($args['contextParams']===null){$args['context']=\stream_context_create($args['context']);}else{$args['context']=\stream_context_create($args['context'],$args['contextParams']);}}$args['result']=\file_put_contents($args['filename'],$args['data'],$args['flags'],$args['context']);},static function($type,$message,$file,$line)use(&$args){$args['errors']??=[];$args['errors'][]=[$message,$type,$file,$line];\Inilim\Tool\Method\Other\__setErrorLast(-1,$message,'',-1);});if($args['errors']){$args['exception']=\Inilim\Tool\Method\Obj\getCollectionThrowable();foreach($args['errors']as $err){[$message,$type,$file,$line]=$err;$args['exception'][]=new \ErrorException($message,$type,$type,$file,$line);}unset($args['errors']);}if($args['result']===false){if($throw&&$args['exception']){throw $args['exception'];}return['result'=>-1,'exception'=>$args['exception']];}return['result'=>$args['result'],'exception'=>$args['exception']];}
    }if(!\Inilim\Tool\File::__definedIfNot('toCharsGenerator')){
    function toCharsGenerator(string $pathToFile,int $chunk=1):\Generator{\Inilim\Tool\Method\Assert\file($pathToFile);$resource=\Inilim\Tool\Method\File\phpfopen($pathToFile,'r');if($resource===false){throw new \Exception(\sprintf('Failed open file: "%s"',$pathToFile));}$iteration=0;while(true){$r=\Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function()use(&$iteration,$resource,$chunk){$posFrom=\ftell($resource);if($posFrom===false){return null;}$chars=\fread($resource,10*$chunk);if($chars===false){return null;}$chars=\mb_substr($chars,0,$chunk,'UTF-8');\fseek($resource,$posFrom+\strlen($chars));$posTo=\ftell($resource);if($posTo===false){return null;}if($posFrom===$posTo){return null;}return[['iter'=>$iteration,'posFrom'=>$posFrom,'posTo'=>$posTo],$chars];});if($r===null){break;}[$key,$value]=$r;yield $key=>$value;$iteration++;}\Inilim\Tool\Method\File\phpfclose($resource);}
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
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('__resource')){
    function __resource(string $class,string $name){$_class=\basename(\dirname(\strtr($class,'\\','/')));$name=\sprintf('%s/../../../files/resources/%s/%s.php',__DIR__,$_class,$name);if(\is_file($name)){return require $name;}return null;}
    }if(!\Inilim\Tool\Other::__definedIfNot('__setErrorLast')){
    function __setErrorLast(int $type,string $message,string $file,int $line):void{\Inilim\Tool\Method\Other\__state()-> error=['type'=>$type,'message'=>$message,'file'=>$file,'line'=>$line];}
    }if(!\Inilim\Tool\Other::__definedIfNot('__state')){
    function __state():object{static $o=null;return $o ??= new class{var?array $error=null;};}
    }if(!\Inilim\Tool\Other::__definedIfNot('_refDots')){
    function _refDots(array $array):array{$dots=[];foreach($array as&$value){$dots[]=&$value;}$array['...']=$dots;return $array;}
    }if(!\Inilim\Tool\Other::__definedIfNot('bindAndCall')){
    function bindAndCall(object $object,\Closure $callback,... $args){$result=$callback -> bindTo($object,$object)-> __invoke(... $args);\Inilim\Tool\Method\Other\clearClosure($callback);return $result;}
    }if(!\Inilim\Tool\Other::__definedIfNot('clearClosure')){
    function clearClosure(\Closure $cls){return $cls -> bindTo(null,null);}
    }if(!\Inilim\Tool\Other::__definedIfNot('getPathFromResource')){
    function getPathFromResource($resource):?string{\Inilim\Tool\Method\Assert\resource($resource);return \stream_get_meta_data($resource)['uri']?? null;}
    }if(!\Inilim\Tool\Other::__definedIfNot('getType')){
    function getType($v,bool $trueFalseAsSeparateType=false):string{$r=\gettype($v);switch($r){case 'NULL':return 'null';case 'double':return 'float';case 'object':if(\PHP_VERSION_ID>=80100&&$v instanceof \UnitEnum){return 'enum';}if($v instanceof \Throwable){return 'exception';}return 'object';case 'boolean':if($trueFalseAsSeparateType){return $v===true?'true':'false';}return 'bool';case 'integer':return 'int';case 'resource (closed)':return 'resource_closed';case 'unknown type':return 'unknown_type';default:return $r;}}
    }if(!\Inilim\Tool\Other::__definedIfNot('timedMsCall')){
    function timedMsCall(callable $callable):array{$m=\memory_get_usage(true);$ms=\Inilim\Tool\Method\Time\unixMs();$result=$callable();$ms=\Inilim\Tool\Method\Time\unixMs()-$ms;$m=\memory_get_usage(true)-$m;return \Inilim\Tool\Method\Other\_refDots(['result'=>$result,'time'=>$ms,'memory'=>$m]);}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler_m2')){
    function tryCallWithErrHandler_m2(callable $callable,?callable $handler=null,int $errorLevels=\E_ALL){if($handler===null){$handler=static function($levelOrCode,$message,$file,$line){\Inilim\Tool\Method\Other\__setErrorLast($levelOrCode,$message,$file,$line);};}return \Inilim\Tool\Method\Other\tryCallWithErrHandler($callable,$handler,$errorLevels);}
    }if(!\Inilim\Tool\Other::__definedIfNot('valueToString')){
    function valueToString($value):string{$type=\Inilim\Tool\Method\Other\getType($value,true);if($type==='string'){return '"'.$value.'"';}if(\in_array($type,['true','false','null','resource','resource_closed','array'])){return $type;}if(\in_array($type,['object','exception'])){if(\method_exists($value,'__toString')){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> __toString());}if($value instanceof \DateTime||$value instanceof \DateTimeImmutable){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> format('c'));}return \get_class($value);}if($type==='enum'){if(\enum_exists(\get_class($value))){return \get_class($value).'::'.$value -> name;}return \get_class($value);}return (string) $value;}
    }}namespace Inilim\Tool\Method\FS{if(!\Inilim\Tool\FS::__definedIfNot('unlink')){
    function unlink(string $filename,$context=null):bool{$value=\Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function()use($filename,$context){$result=$context?\unlink($filename,$context):\unlink($filename);if($result){\clearstatcache(false,$filename);return true;}return false;});return $value===null?false:$value;}
    }}namespace Inilim\Tool\Method\Time{if(!\Inilim\Tool\Time::__definedIfNot('unixMs')){
    function unixMs():int{$t=\microtime(false);return \intval(\substr($t,11).\substr($t,2,3));}
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
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('file')){
    function file($value,string $message=''){\Inilim\Tool\Method\Assert\string($value);if(!\is_file($value)){throw new \InvalidArgumentException(\sprintf($message?:'The path %s is not a file.',\Inilim\Tool\Method\Other\valueToString($value)));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('resource')){
    function resource($value,?string $type=null,string $message=''){if($type!==null&&!\Inilim\Tool\Method\Check\resource($value,$type)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a resource of type %2$s. Got: %s',\Inilim\Tool\Method\Other\getType($value),$type));}if(!\Inilim\Tool\Method\Check\resource($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a resource. Got: %s',\Inilim\Tool\Method\Other\getType($value),$type));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('string')){
    function string($value,string $message=''){if(!\is_string($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected a string. Got: %s',\Inilim\Tool\Method\Other\getType($value)));}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('resource')){
    function resource($value,?string $type=null):bool{if(!\is_resource($value)){return false;}if($type&&$type!==\get_resource_type($value)){return false;}return true;}
    }}