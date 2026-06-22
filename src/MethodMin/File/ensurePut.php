<?php

declare(strict_types=1);namespace Inilim\Tool\Method\File{function ensurePut(string $filename,$data,int $flags=0,bool $throw=false,int $mode=0755,$context=null,?array $contextParams=null):array{$dir=\dirname($filename);$d=null;if(!\Inilim\Tool\Method\FS\isDir($dir)){$d=\Inilim\Tool\Method\FS\makeDir($dir,false,$mode,true);}$f=\Inilim\Tool\Method\File\put($filename,$data,$flags,false,$context,$contextParams);if($d===null){return $f;}if($f['exception']&&$d['exception']){$ce=\Inilim\Tool\Method\Obj\getCollectionThrowable('File::ensurePut(...)');foreach([... $d['exception'],... $f['exception']]as $e){$ce[]=$e;}if($throw){throw $ce;}$f['exception']=$ce;}return $f;}if(!\Inilim\Tool\File::__definedIfNot('put')){
    function put(string $filename,$data,int $flags=0,bool $throw=false,$context=null,?array $contextParams=null):array{$args=['filename'=>$filename,'data'=>$data,'flags'=>$flags,'context'=>$context,'contextParams'=>$contextParams,'result'=>null,'exception'=>null,'errors'=>null];\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$args){if(\is_array($args['context'])){if($args['contextParams']===null){$args['context']=\stream_context_create($args['context']);}else{$args['context']=\stream_context_create($args['context'],$args['contextParams']);}}$args['result']=\file_put_contents($args['filename'],$args['data'],$args['flags'],$args['context']);},static function($type,$message,$file,$line)use(&$args){$args['errors']??=[];$args['errors'][]=[$message,$type,$file,$line];\Inilim\Tool\Method\Other\__setErrorLast(-1,$message,'',-1);});if($args['errors']){$args['exception']=\Inilim\Tool\Method\Obj\getCollectionThrowable();foreach($args['errors']as $err){[$message,$type,$file,$line]=$err;$args['exception'][]=new \ErrorException($message,$type,$type,$file,$line);}unset($args['errors']);}if($args['result']===false){if($throw&&$args['exception']){throw $args['exception'];}return['result'=>-1,'exception'=>$args['exception']];}return['result'=>$args['result'],'exception'=>$args['exception']];}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('__setErrorLast')){
    function __setErrorLast(int $type,string $message,string $file,int $line):void{\Inilim\Tool\Method\Other\__state()-> error=['type'=>$type,'message'=>$message,'file'=>$file,'line'=>$line];}
    }if(!\Inilim\Tool\Other::__definedIfNot('__state')){
    function __state():object{static $o=null;return $o ??= new class{var?array $error=null;};}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler_m2')){
    function tryCallWithErrHandler_m2(callable $callable,?callable $handler=null,int $errorLevels=\E_ALL){if($handler===null){$handler=static function($levelOrCode,string $message,string $file,int $line){\Inilim\Tool\Method\Other\__setErrorLast((int) $levelOrCode,$message,$file,$line);};}return \Inilim\Tool\Method\Other\tryCallWithErrHandler($callable,$handler,$errorLevels);}
    }}namespace Inilim\Tool\Method\FS{if(!\Inilim\Tool\FS::__definedIfNot('isDir')){
    function isDir(string $filename):bool{$value=\Inilim\Tool\Method\Other\tryCallWithErrHandler_m2(static function()use($filename){\clearstatcache(false,$filename);return \is_dir($filename);});return $value===null?false:$value;}
    }if(!\Inilim\Tool\FS::__definedIfNot('makeDir')){
    function makeDir(string $path,bool $throw=false,int $mode=0755,bool $recursive=false,bool $force=false,$context=null,?array $contextParams=null):array{$args=['path'=>$path,'mode'=>$mode,'recursive'=>$recursive,'force'=>$force,'context'=>$context,'contextParams'=>$contextParams,'result'=>null,'exception'=>null,'errors'=>null];\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$args){if(\is_array($args['context'])){if($args['contextParams']===null){$args['context']=\stream_context_create($args['context']);}else{$args['context']=\stream_context_create($args['context'],$args['contextParams']);}}if($args['force']){$args['result']=@\mkdir($args['path'],$args['mode'],$args['recursive'],$args['context']);}else{$args['result']=\mkdir($args['path'],$args['mode'],$args['recursive'],$args['context']);}},static function($type,$message,$file,$line,$context)use(&$args){if($context['isSuppress']){return;}$args['errors']??=[];$args['errors'][]=[$message,$type,$file,$line];\Inilim\Tool\Method\Other\__setErrorLast(-1,$message,'',-1);});if($args['errors']){$args['exception']=\Inilim\Tool\Method\Obj\getCollectionThrowable('FS::makeDir(...)');foreach($args['errors']as $err){[$message,$type,$file,$line]=$err;$args['exception'][]=new \ErrorException($message,$type,$type,$file,$line);}unset($args['errors']);}if($args['result']===false){if($throw&&$args['exception']){throw $args['exception'];}return['result'=>null,'exception'=>$args['exception']];}return['result'=>$args['result'],'exception'=>$args['exception']];}
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
    }}