<?php

declare(strict_types=1);namespace Inilim\Tool\Method\File{function cacheRead($pathToFile,bool $throw=false,bool $abortIfErr=false){$args=['result'=>[],'once'=>false,'exception'=>null,'curFile'=>null,'abortIfErr'=>$abortIfErr];if(\is_string($pathToFile)){$args['once']=true;$pathToFile=[$pathToFile];}$args['files']=$pathToFile;\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$args){foreach($args['files']as $idx=>$file){$args['curFile']=$file;$args['result'][$idx]=null;try{if(!\is_file($file)||!$h=@\fopen($file,'r')){continue;}if(($expiresAt=(int) \fgets($h))&&\time()>=$expiresAt){\fclose($h);@\unlink($file);\clearstatcache(false,$file);continue;}$data=\stream_get_contents($h);if($data===false){$data='';}\fclose($h);if(''===$data){continue;}if('b:0;'===$data){$args['result'][$idx]=false;continue;}$data=\unserialize($data);if($data===false){continue;}$args['result'][$idx]=$data;continue;}catch(\ErrorException $e){$args['exception']??= \Inilim\Tool\Method\Obj\getCollectionThrowable();$args['exception'][]=$e;if($args['abortIfErr']){break;}}}},static function($type,$message)use(&$args){$context=\func_get_arg(4);if($context['isSuppress']){return;}throw new \ErrorException($message,0,$type,$args['curFile']);});if($throw&&$args['exception']){throw $args['exception'];}if($args['once']){return['result'=>$args['result'][0],'exception'=>$args['exception']];}return['result'=>$args['result'],'exception'=>$args['exception']];}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
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