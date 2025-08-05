<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp{function fgcSend(string $url,string $method='GET',?string $body=null,array $headers=[],array $ctxOptions=[]){$method=\strtoupper($method);\Inilim\Tool\Method\Assert\inArray($method,['GET','POST','PUT','PATCH','DELETE','OPTIONS'],'$method allowed GET,POST,PUT,PATCH,DELETE,OPTIONS');$http=['method'=>$method,'timeout'=>5.0,'follow_location'=>1,'max_redirects'=>5];if($body===''){$body=null;}if($body!==null&&$method!=='GET'){$http['content']=$body;}unset($method,$body);$hasUserUgent=false;$hasAccept=false;$hasAcceptEncoding=false;$hasContentType=false;foreach($headers as $name=>&$header){if(\is_string($name)){$header=\sprintf('%s: %s',$name,$header);}if(\Inilim\Tool\Method\Str\startsWith($header,'host:',true)){unset($headers[$name]);continue;}if(\Inilim\Tool\Method\Str\startsWith($header,'connection:',true)){unset($headers[$name]);continue;}if(\Inilim\Tool\Method\Str\startsWith($header,'content-length:',true)){unset($headers[$name]);continue;}if(!$hasAccept&&\Inilim\Tool\Method\Str\startsWith($header,'accept:',true)){$hasAccept=true;}if(!$hasContentType&&\Inilim\Tool\Method\Str\startsWith($header,'content-type:',true)){$hasContentType=true;}if(!$hasUserUgent&&\Inilim\Tool\Method\Str\startsWith($header,'user-agent:',true)){$hasUserUgent=true;}if(!$hasAcceptEncoding&&\Inilim\Tool\Method\Str\startsWith($header,'accept-encoding:',true)){$hasAcceptEncoding=true;}}if(!$hasContentType){$headers[]='content-type:';}if(isset($http['content'])){}if(!$hasUserUgent){$headers[]='user-agent: '.__FUNCTION__;}if(!$hasAccept){$headers[]='accept: */*';}if(!$hasAcceptEncoding){}if(isset($http['protocol_version'])&&$http['protocol_version']===1.1||\Inilim\Tool\Method\Check\php80()){$headers[]='connection: close';}$http['header']=\implode("\r\n",$headers);unset($headers);$ctxOptions['ssl']['verify_peer']=false;$ctxOptions['ssl']['verify_peer_name']=false;$ctxParams=null;if(isset($ctxOptions['debug'])&&$ctxOptions['debug']===true&&\defined('STDOUT')){$ident=$http['method'].' '.$url;$fn1=static function(int $code,... $passed)use($ident):void{$map=[\STREAM_NOTIFY_CONNECT=>'CONNECT',\STREAM_NOTIFY_AUTH_REQUIRED=>'AUTH_REQUIRED',\STREAM_NOTIFY_AUTH_RESULT=>'AUTH_RESULT',\STREAM_NOTIFY_MIME_TYPE_IS=>'MIME_TYPE_IS',\STREAM_NOTIFY_FILE_SIZE_IS=>'FILE_SIZE_IS',\STREAM_NOTIFY_REDIRECTED=>'REDIRECTED',\STREAM_NOTIFY_PROGRESS=>'PROGRESS',\STREAM_NOTIFY_FAILURE=>'FAILURE',\STREAM_NOTIFY_COMPLETED=>'COMPLETED',\STREAM_NOTIFY_RESOLVE=>'RESOLVE'];$args=['severity','message','message_code','bytes_transferred','bytes_max'];\fprintf(\STDOUT,'<%s> [%s] ',$ident,$map[$code]);foreach(\array_filter($passed)as $i=>$v){\fwrite(\STDOUT,$args[$i].': "'.$v.'" ');}\fwrite(\STDOUT,"\n");};$ctxParams=['notification'=>$fn1];unset($fn1,$ident);}if(isset($ctxOptions['http'])&&\is_array($ctxOptions['http'])){$http=\array_merge($http,$ctxOptions['http']);}$ctxOptions['http']=$http;unset($http);$resourceContext=\stream_context_create($ctxOptions,$ctxParams);unset($ctxParams);$ms=\Inilim\Tool\Method\Time\unixMs();$result=\Inilim\Tool\Method\File\getViaArray(['context'=>$resourceContext,'pathToFile'=>$url]);unset($resourceContext);$flagResultNull=$result['result']===null;if($flagResultNull){$ms=-1;}else{$ms=\Inilim\Tool\Method\Time\unixMs()-$ms;}$code=-1;if(!$flagResultNull){$code=$result['http_response_header'][0]??-1;if($code!==-1){\preg_match('/\s([0-9]{3})\s/',$code,$m);$code=\intval($m[1]??-1);unset($m);}}$size=-1;if(!$flagResultNull){$size=\strlen($result['result']);}if($result['exception']){}return['response'=>['body'=>$result['result'],'headers'=>$result['http_response_header']??[],'code'=>$code,'size'=>$size,'time'=>$ms],'request'=>['url'=>$url,'body'=>$ctxOptions['http']['content']?? null,'method'=>$ctxOptions['http']['method'],'headers'=>$ctxOptions['http']['header']]];}}namespace Inilim\Tool\Method\File{if(!\Inilim\Tool\File::__definedIfNot('get')){
    function get(string $pathToFile,int $offset=0,?int $length=null,bool $useIncludePath=false,bool $throw=false,$context=null,?array $contextParams=null):array{$args=['pathToFile'=>$pathToFile,'offset'=>$offset,'length'=>$length,'useIncludePath'=>$useIncludePath,'context'=>$context,'contextParams'=>$contextParams,'result'=>null,'result'=>null,'exception'=>null,'errors'=>null,'http_response_header'=>null];\Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use(&$args){if(\is_array($args['context'])){if($args['contextParams']===null){$args['context']=\stream_context_create($args['context']);}else{$args['context']=\stream_context_create($args['context'],$args['contextParams']);}}if($args['length']===null){$args['result']=\file_get_contents($args['pathToFile'],$args['useIncludePath'],$args['context'],$args['offset']);}else{$args['result']=\file_get_contents($args['pathToFile'],$args['useIncludePath'],$args['context'],$args['offset'],$args['length']);}if(isset($http_response_header)){$args['http_response_header']=$http_response_header;}},static function($type,$message,$file,$line)use(&$args){$args['errors']??=[];$args['errors'][]=[$message,$type,$file,$line];});if($args['errors']){$args['exception']=\Inilim\Tool\Method\Obj\getCollectionThrowable('File::get(...)');foreach($args['errors']as $err){[$message,$type,$file,$line]=$err;$args['exception'][]=new \ErrorException($message,$type,$type,$file,$line);}unset($args['errors']);}if($args['result']===false){if($throw&&$args['exception']){throw $args['exception'];}return['result'=>null,'exception'=>$args['exception'],'http_response_header'=>$args['http_response_header']];}return['result'=>$args['result'],'exception'=>$args['exception'],'http_response_header'=>$args['http_response_header']];}
    }if(!\Inilim\Tool\File::__definedIfNot('getViaArray')){
    function getViaArray(array $params):array{return \Inilim\Tool\Method\File\get($params['pathToFile'],$params['offset']?? 0,$params['length']?? null,$params['useIncludePath']?? false,$params['throw']?? false,$params['context']?? null,$params['contextParams']?? null);}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('startsWith')){
    function startsWith(string $haystack,$needles,bool $ignoreCase=false):bool{if($ignoreCase){$haystack=\mb_strtolower($haystack,'UTF-8');}if(!\is_iterable($needles)){$needles=[$needles];}foreach($needles as $needle){if($ignoreCase){$needle=\mb_strtolower($needle,'UTF-8');}if((string) $needle!==''&&\Inilim\Tool\Method\PF\str_starts_with($haystack,$needle)){return true;}}return false;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('funcPhp')){
    function funcPhp(string $function,bool $rechecking=false):bool{static $o=null;$o ??=[];$function=\ltrim($function,'\\');if(isset($o[$function])&&!$rechecking){return $o[$function];}return $o[$function]=\function_exists($function);}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if($use['handler']===null){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }if(!\Inilim\Tool\Other::__definedIfNot('valueToString')){
    function valueToString($value):string{if(null===$value){return 'null';}if(true===$value){return 'true';}if(false===$value){return 'false';}if(\is_array($value)){return 'array';}if(\is_object($value)){if(\method_exists($value,'__toString')){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> __toString());}if($value instanceof \DateTime||$value instanceof \DateTimeImmutable){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> format('c'));}if(\Inilim\Tool\Method\Other\funcPhp('enum_exists')&&\enum_exists(\get_class($value))){return \get_class($value).'::'.$value -> name;}return \get_class($value);}if(\is_resource($value)){return 'resource';}if(\is_string($value)){return '"'.$value.'"';}return (string) $value;}
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
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('inArray')){
    function inArray($value,array $values,string $message=''){if(!\in_array($value,$values,true)){throw new \InvalidArgumentException(\sprintf($message?:'Expected one of: %2$s. Got: %s',\Inilim\Tool\Method\Other\valueToString($value),\implode(', ',\array_map('\Inilim\Tool\Method\Other\valueToString',$values))));}}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_starts_with')){
    function str_starts_with(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }}