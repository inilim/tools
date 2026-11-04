<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert{function nullOrIntegerish($value,$message=''){null===$value||\Inilim\Tool\Method\Assert\integerish($value,$message);return $value;}if(!\Inilim\Tool\Assert::__definedIfNot('integerish')){
    function integerish($value,$message=''){if(!\is_numeric($value)||$value!=(int) $value){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument(\sprintf($message?:'Expected an integerish value. Got: %s',\Inilim\Tool\Method\Assert\__typeToString($value)));}return $value;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__reportInvalidArgument')){
    function __reportInvalidArgument(string $message){throw new \InvalidArgumentException($message);}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__resolveMessage')){
    function __resolveMessage($message):string{return \is_callable($message)?$message():$message;}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__typeToString')){
    function __typeToString($value):string{return \is_object($value)?\get_class($value):\gettype($value);}
    }}