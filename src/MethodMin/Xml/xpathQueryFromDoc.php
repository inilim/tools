<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Xml{function xpathQueryFromDoc(object $doc,string $expression,?object $contextNode=null,bool $registerNodeNS=true):?array{\Inilim\Tool\Method\Assert\extPhp('dom');\Inilim\Tool\Method\Assert\isInstanceOf($doc,\DOMDocument :: class);if($contextNode){\Inilim\Tool\Method\Assert\isInstanceOf($contextNode,\DOMNode :: class);}return \Inilim\Tool\Method\Other\tryCallWithErrHandler(static function()use($doc,$expression,$contextNode,$registerNodeNS){$xpath=new \DOMXpath($doc);$list=$xpath -> query($expression,$contextNode,$registerNodeNS);if(\is_bool($list)){\Inilim\Tool\Method\Other\__setErrorLast(-1,\sprintf('DOMXpath::query("%s") failed',$expression),'',-1);return null;}return['doc'=>$doc,'xpath'=>$xpath,'list'=>$list];},null);}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&false===$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
    }if(!\Inilim\Tool\Other::__definedIfNot('tryCallWithErrHandler')){
    function tryCallWithErrHandler(callable $callable,?callable $handler,int $errorLevels=\E_ALL){$use=['handler'=>$handler,'exception'=>null,'result'=>null,'obj'=>new \stdClass()];$wrapHandler=static function($levelOrCode,$message,$file,$line,$context=[])use(&$use){if(null===$use['handler']){return true;}$context['isException']=isset($context['exception']);$context['isSuppress']=$context['isException']?false:!(\error_reporting()&$levelOrCode);$context['obj']=$use['obj'];try{$handlerResult=$use['handler']($levelOrCode,$message,$file,$line,$context);}catch(\Throwable $e){$use['exception']=$e;throw $e;}return $handlerResult!==false?true:false;};\set_error_handler($wrapHandler,$errorLevels);try{$use['result']=$callable($use['obj']);}catch(\Throwable $e){\restore_error_handler();if($use['exception']){throw $use['exception'];}$wrapHandler -> __invoke($e -> getCode(),$e -> getMessage(),$e -> getFile(),$e -> getLine(),['exception'=>$e]);return $use['result'];}\restore_error_handler();return $use['result'];}
    }if(!\Inilim\Tool\Other::__definedIfNot('__setErrorLast')){
    function __setErrorLast(int $type,string $message,string $file,int $line):void{\Inilim\Tool\Method\Other\__state()-> error=['type'=>$type,'message'=>$message,'file'=>$file,'line'=>$line];}
    }if(!\Inilim\Tool\Other::__definedIfNot('__state')){
    function __state():object{static $o=null;return $o ??= new class{var?array $error=null;};}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('extPhp')){
    function extPhp(string $nameExt,string $message=''){if(false===\Inilim\Tool\Method\Other\extPhp($nameExt)){throw new \InvalidArgumentException(\sprintf($message?:'PHP Extension "%s" not found',$nameExt));}}
    }if(!\Inilim\Tool\Assert::__definedIfNot('isInstanceOf')){
    function isInstanceOf($value,$class,$message=''){\Inilim\Tool\Method\Assert\string($class,'Expected class as a string. Got: %s');if(!$value instanceof $class){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf($message?:'Expected an instance of %2$s. Got: %s',\Inilim\Tool\Method\Assert\__typeToString($value),$class));}return $value;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('string')){
    function string($value,$message=''){if(!\is_string($value)){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf($message?:'Expected a string. Got: %s',\Inilim\Tool\Method\Assert\__typeToString($value)));}return $value;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__reportInvalidArgument')){
    function __reportInvalidArgument(string $message){throw new \InvalidArgumentException($message);}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__resolveMessage')){
    function __resolveMessage($message):string{return \is_callable($message)?$message():$message;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__typeToString')){
    function __typeToString($value):string{return \is_object($value)?\get_class($value):\gettype($value);}
    }}