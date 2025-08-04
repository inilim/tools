<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\File{function jsonViaArray(array $params){return \Inilim\Tool\Method\File\json($params['pathToFile'],$params['flags']?? 0,$params['lock']?? false,$params['throw']?? false,$params['default']?? null);}if(!\Inilim\Tool\File::__definedIfNot('get')){
    function get(string $pathToFile,int $offset=0,?int $length=null,bool $useIncludePath=false,bool $throw=false,$context=null,?array $contextParams=null):array{$args=['pathToFile'=>$pathToFile,'offset'=>$offset,'length'=>$length,'useIncludePath'=>$useIncludePath,'context'=>$context,'contextParams'=>$contextParams,'result'=>null,'result'=>null,'exception'=>null,'errors'=>null,'http_response_header'=>null];\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$args){if(\is_array($args['context'])){if($args['contextParams']===null){$args['context']=\stream_context_create($args['context']);}else{$args['context']=\stream_context_create($args['context'],$args['contextParams']);}}if($args['length']===null){$args['result']=\file_get_contents($args['pathToFile'],$args['useIncludePath'],$args['context'],$args['offset']);}else{$args['result']=\file_get_contents($args['pathToFile'],$args['useIncludePath'],$args['context'],$args['offset'],$args['length']);}if(isset($http_response_header)){$args['http_response_header']=$http_response_header;}},static function($type,$message,$file,$line)use(&$args){$args['errors']??=[];$args['errors'][]=[$message,$type,$file,$line];});if($args['errors']){$args['exception']=\Inilim\Tool\Method\Obj\getCollectionThrowable('File::get(...)');foreach($args['errors']as $err){[$message,$type,$file,$line]=$err;$args['exception'][]=new \ErrorException($message,$type,$type,$file,$line);}unset($args['errors']);}if($args['result']===false){if($throw&&$args['exception']){throw $args['exception'];}return['result'=>null,'exception'=>$args['exception'],'http_response_header'=>$args['http_response_header']];}return['result'=>$args['result'],'exception'=>$args['exception'],'http_response_header'=>$args['http_response_header']];}
    }if(!\Inilim\Tool\File::__definedIfNot('json')){
    function json(string $pathToFile,int $flags=0,bool $lock=false,bool $throw=false,$default=null){if($lock){$result=\Inilim\Tool\Method\File\sharedGet($pathToFile);}else{$result=\Inilim\Tool\Method\File\get($pathToFile);}if($result['exception']){if($throw){throw $result['exception'];}return $default;}if(!\Inilim\Tool\Method\Check\isJson($result['result'])){if($throw){throw new \JsonException(\sprintf('Content file not json "%s"',$pathToFile));}return $default;}return \json_decode($result['result'],true,512,$flags);}
    }if(!\Inilim\Tool\File::__definedIfNot('sharedGet')){
    function sharedGet(string $pathToFile,bool $throw=false):array{$args=['pathToFile'=>$pathToFile,'result'=>null,'e'=>null,'errors'=>null];\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$args){$handle=\fopen($args['pathToFile'],'rb');if($handle){try{if(\flock($handle,\LOCK_SH)){\clearstatcache(true,$args['pathToFile']);$args['result']=\fread($handle,\filesize($args['pathToFile'])?:1);\flock($handle,\LOCK_UN);}}finally{\fclose($handle);}}},static function($type,$message,$file,$line)use(&$args){$args['errors']??=[];$args['errors'][]=[$message,$type,$file,$line];});if($args['errors']){$args['e']=\Inilim\Tool\Method\Obj\getCollectionThrowable();foreach($args['errors']as $err){$args['e'][]=new \ErrorException($err[0],$err[1],$err[1],$err[2],$err[3]);}unset($args['errors']);}if($args['result']===false||$args['result']===null){if($throw&&$args['e']){throw $args['e'];}return['result'=>null,'exception'=>$args['e']];}return['result'=>$args['result'],'exception'=>$args['e']];}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
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
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('isJson')){
    function isJson($value):bool{if(!\is_string($value)){return false;}return \Inilim\Tool\Method\PF\json_validate($value);}
    }if(!\Inilim\Tool\Check::__definedIfNot('php83')){
    function php83():bool{return \PHP_VERSION_ID>=80300?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('json_validate')){
    function json_validate(string $json,int $depth=512,int $flags=0):bool{if(\Inilim\Tool\Method\Check\php83()){return \json_validate($json,$depth,$flags);}if(0!==$flags&&\defined('JSON_INVALID_UTF8_IGNORE')&&\JSON_INVALID_UTF8_IGNORE!==$flags){throw new \ValueError('PF::json_validate(): Argument #3 ($flags) must be a valid flag (allowed flags: JSON_INVALID_UTF8_IGNORE)');}if($depth<=0){throw new \ValueError('PF::json_validate(): Argument #2 ($depth) must be greater than 0');}$json_max_depth=0x7fffffff;if($depth>$json_max_depth){throw new \ValueError(\sprintf('PF::json_validate(): Argument #2 ($depth) must be less than %d',$json_max_depth));}\json_decode($json,null,$depth,$flags);return \JSON_ERROR_NONE===\json_last_error();}
    }}