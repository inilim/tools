<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert{function httpHeaderValue($value,string $message=''){\Inilim\Tool\Method\Assert\string($value,$message?:'Header value must be a string but %s provided.');if(!\Inilim\Tool\Method\Check\httpHeaderValue($value)){throw new \InvalidArgumentException(\sprintf('"%s" is not valid header value.',$value));}}if(!\Inilim\Tool\Assert::__definedIfNot('string')){
    function string($value,$message=''){if(!\is_string($value)){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf($message?:'Expected a string. Got: %s',\Inilim\Tool\Method\Assert\__typeToString($value)));}return $value;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__reportInvalidArgument')){
    function __reportInvalidArgument(string $message){throw new \InvalidArgumentException($message);}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__resolveMessage')){
    function __resolveMessage($message):string{return \is_callable($message)?$message():$message;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__typeToString')){
    function __typeToString($value):string{return \is_object($value)?\get_class($value):\gettype($value);}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('httpHeaderValue')){
    function httpHeaderValue($value):bool{return \is_string($value)&&(bool) \preg_match('/^[\x20\x09\x21-\x7E\x80-\xFF]*$/D',$value);}
    }}