<?php

declare(strict_types=1);namespace Inilim\Tool\Method\File{function unserialize(string $pathToFile,array $options=[],bool $lock=false,bool $throw=false,$default=null){if($lock){$data=\Inilim\Tool\Method\File\sharedGet($pathToFile,$throw);}else{$data=\Inilim\Tool\Method\File\get($pathToFile,0,null,false,$throw);}if($data['exception']){if($throw){throw $data['exception'];}return $default;}$data=$data['result'];if($data===''){return null;}if($data==='b:0;'){return false;}$errors=[];$undata=\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$data,&$options){return \unserialize($data,$options);},static function($type,$message,$file,$line)use(&$errors,$throw){if($throw){$errors[]=[$message,$type,$file,$line];}else{$errors[]=null;}});if($errors){if($throw){$e=\Inilim\Tool\Method\Obj\getCollectionThrowable();foreach($errors as $err){$e[]=new \ErrorException($err[0],$err[1],$err[1],$err[2],$err[3]);}throw $e;}return $default;}unset($data);if($undata===null||$undata===false){return $default;}return $undata;}if(!\Inilim\Tool\File::__definedIfNot('get')){
    function get(string $pathToFile,int $offset=0,?int $length=null,bool $useIncludePath=false,bool $throw=false,$context=null,?array $contextParams=null):array{$args=['pathToFile'=>$pathToFile,'offset'=>$offset,'length'=>$length,'useIncludePath'=>$useIncludePath,'context'=>$context,'contextParams'=>$contextParams,'result'=>null,'result'=>null,'exception'=>null,'errors'=>null,'http_response_header'=>null];\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$args){if(\is_array($args['context'])){if($args['contextParams']===null){$args['context']=\stream_context_create($args['context']);}else{$args['context']=\stream_context_create($args['context'],$args['contextParams']);}}if($args['length']===null){$args['result']=\file_get_contents($args['pathToFile'],$args['useIncludePath'],$args['context'],$args['offset']);}else{$args['result']=\file_get_contents($args['pathToFile'],$args['useIncludePath'],$args['context'],$args['offset'],$args['length']);}$nameHRH='http_response_header';if(\Inilim\Tool\Method\Check\php84()){$args[$nameHRH]=\http_get_last_response_headers();}elseif(isset(${$nameHRH})){$args[$nameHRH]=${$nameHRH};}},static function($type,$message,$file,$line)use(&$args){$args['errors']??=[];$args['errors'][]=[$message,$type,$file,$line];});if($args['errors']){$args['exception']=\Inilim\Tool\Method\Obj\getCollectionThrowable('File::get(...)');foreach($args['errors']as $err){[$message,$type,$file,$line]=$err;$args['exception'][]=new \ErrorException($message,$type,$type,$file,$line);}unset($args['errors']);}if($args['result']===false){if($throw&&$args['exception']){throw $args['exception'];}return['result'=>null,'exception'=>$args['exception'],'http_response_header'=>$args['http_response_header']];}return['result'=>$args['result'],'exception'=>$args['exception'],'http_response_header'=>$args['http_response_header']];}
    }if(!\Inilim\Tool\File::__definedIfNot('sharedGet')){
    function sharedGet(string $pathToFile,bool $throw=false):array{$args=['pathToFile'=>$pathToFile,'result'=>null,'e'=>null,'errors'=>null];\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$args){$handle=\fopen($args['pathToFile'],'rb');if($handle){try{if(\flock($handle,\LOCK_SH)){\clearstatcache(true,$args['pathToFile']);$args['result']=\fread($handle,\filesize($args['pathToFile'])?:1);\flock($handle,\LOCK_UN);}}finally{\fclose($handle);}}},static function($type,$message,$file,$line)use(&$args){$args['errors']??=[];$args['errors'][]=[$message,$type,$file,$line];});if($args['errors']){$args['e']=\Inilim\Tool\Method\Obj\getCollectionThrowable();foreach($args['errors']as $err){$args['e'][]=new \ErrorException($err[0],$err[1],$err[1],$err[2],$err[3]);}unset($args['errors']);}if($args['result']===false||$args['result']===null){if($throw&&$args['e']){throw $args['e'];}return['result'=>null,'exception'=>$args['e']];}return['result'=>$args['result'],'exception'=>$args['e']];}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }}namespace Inilim\Tool\Method\Obj{if(!\Inilim\Tool\Obj::__definedIfNot('getCollectionThrowable')){
    function getCollectionThrowable(string $message = '', int $code = 0, ?int $line = null, ?string $file = null, ?\Throwable $previous = null): object
{
    return new class($message, $code, $line, $file, $previous) extends \Exception implements \ArrayAccess, \IteratorAggregate, \Countable
    {
        protected array $a = [];
        function __construct(string $message, int $code, ?int $line, ?string $file, ?\Throwable $previous)
        {
            parent::__construct($message, $code, $previous);
            $this->line = $line ?? -1;
            $this->file = $file ?? '';
        }
        function getIterator(): \Generator
        {
            foreach ($this->a as $k => $e) {
                yield $k => $e;
            }
        }
        #[\ReturnTypeWillChange]
        function offsetExists($offset): bool
        {
            return isset($this->a[$offset]);
        }
        #[\ReturnTypeWillChange]
        function offsetGet($offset): ?\Throwable
        {
            return $this->a[$offset] ?? null;
        }
        #[\ReturnTypeWillChange]
        function offsetSet($offset, $e): void
        {
            if (!$e instanceof \Throwable) {
                throw new \InvalidArgumentException('Value must be of type \Throwable');
            }
            if ($offset === null) {
                $this->a[] = $e;
            } else {
                $this->a[$offset] = $e;
            }
        }
        #[\ReturnTypeWillChange]
        function offsetUnset($offset): void
        {
            unset($this->a[$offset]);
        }
        function count(): int
        {
            return \count($this->a);
        }
    };
}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php84')){
    function php84():bool{return \PHP_VERSION_ID>=80400?true:false;}
    }}