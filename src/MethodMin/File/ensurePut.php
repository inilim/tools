<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File{function ensurePut(string $filename,$data,int $flags=0,bool $throw=false,int $mode=0755,$context=null,?array $contextParams=null):array{$dir=\dirname($filename);$d=null;if(!\is_dir($dir)){$d=\Inilim\Tool\Method\FS\makeDir($dir,false,$mode,true);}$f=\Inilim\Tool\Method\File\put($filename,$data,$flags,false,$context,$contextParams);if($d===null){return $f;}if($f['exception']&&$d['exception']){$ce=\Inilim\Tool\Method\Obj\getCollectionThrowable('File::ensurePut(...)');foreach([... $d['exception'],... $f['exception']]as $e){$ce[]=$e;}if($throw){throw $ce;}$f['exception']=$ce;}return $f;}if(!\Inilim\Tool\File::__definedIfNot('put')){
    function put(string $filename,$data,int $flags=0,bool $throw=false,$context=null,?array $contextParams=null):array{$args=['filename'=>$filename,'data'=>$data,'flags'=>$flags,'context'=>$context,'contextParams'=>$contextParams,'result'=>null,'exception'=>null,'errors'=>null];\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$args){if(\is_array($args['context'])){if($args['contextParams']===null){$args['context']=\stream_context_create($args['context']);}else{$args['context']=\stream_context_create($args['context'],$args['contextParams']);}}$args['result']=\file_put_contents($args['filename'],$args['data'],$args['flags'],$args['context']);},static function($type,$message,$file,$line)use(&$args){$args['errors']??=[];$args['errors'][]=[$message,$type,$file,$line];});if($args['errors']){$args['exception']=\Inilim\Tool\Method\Obj\getCollectionThrowable();foreach($args['errors']as $err){$args['exception'][]=new \ErrorException($err[0],$err[1],$err[1],$err[2],$err[3]);}unset($args['errors']);}if($args['result']===false){if($throw&&$args['exception']){throw $args['exception'];}return['result'=>-1,'exception'=>$args['exception']];}return['result'=>$args['result'],'exception'=>$args['exception']];}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }}namespace Inilim\Tool\Method\FS{if(!\Inilim\Tool\FS::__definedIfNot('makeDir')){
    function makeDir(string $path,bool $throw=false,int $mode=0755,bool $recursive=false,bool $force=false,$context=null,?array $contextParams=null):array{$args=['path'=>$path,'mode'=>$mode,'recursive'=>$recursive,'force'=>$force,'context'=>$context,'contextParams'=>$contextParams,'result'=>null,'exception'=>null,'errors'=>null];\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$args){if(\is_array($args['context'])){if($args['contextParams']===null){$args['context']=\stream_context_create($args['context']);}else{$args['context']=\stream_context_create($args['context'],$args['contextParams']);}}if($args['force']){$args['result']=@\mkdir($args['path'],$args['mode'],$args['recursive'],$args['context']);}else{$args['result']=\mkdir($args['path'],$args['mode'],$args['recursive'],$args['context']);}},static function($type,$message,$file,$line,$context)use(&$args){if($context['isSuppress']){return;}$args['errors']??=[];$args['errors'][]=[$message,$type,$file,$line];});if($args['errors']){$args['exception']=\Inilim\Tool\Method\Obj\getCollectionThrowable('FS::makeDir(...)');foreach($args['errors']as $err){[$message,$type,$file,$line]=$err;$args['exception'][]=new \ErrorException($message,$type,$type,$file,$line);}unset($args['errors']);}if($args['result']===false){if($throw&&$args['exception']){throw $args['exception'];}return['result'=>null,'exception'=>$args['exception']];}return['result'=>$args['result'],'exception'=>$args['exception']];}
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
    }}