<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Xml{function toXml(object $node,int $options=0){\Inilim\Tool\Method\Assert\extPhp('dom');\Inilim\Tool\Method\Assert\isInstanceOf($node,\DOMNode :: class);if($node instanceof \DOMDocument){$v=$node -> saveXML(null,$options);if($v===false){return null;}return $v;}elseif($node -> ownerDocument===null){return null;}$v=$node -> ownerDocument -> saveXML($node,$options);if($v===false){return null;}return $v;}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&false===$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
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