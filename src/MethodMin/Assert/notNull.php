<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Assert{function notNull($value,$message=''){if(null===$value){$message=\Inilim\Tool\Method\Assert\__resolveMessage($message);\Inilim\Tool\Method\Assert\__reportInvalidArgument($message?:'Expected a value other than null.');}return $value;}if(!\Inilim\Tool\Assert::__definedIfNot('__reportInvalidArgument')){
    function __reportInvalidArgument(string $message){throw new \InvalidArgumentException($message);}
    }if(!\Inilim\Tool\Assert::__definedIfNot('__resolveMessage')){
    function __resolveMessage($message):string{return \is_callable($message)?$message():$message;}
    }}