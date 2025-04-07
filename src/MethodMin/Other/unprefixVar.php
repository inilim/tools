<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other{function unprefixVar(string $name){return \Inilim\Tool\Method\Str\trim(\strtr($name,['static::$'=>'','$this->$'=>'','$this->'=>'','self::$'=>'','$'=>'']));}}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('trim')){
    function trim(string $value,?string $charlist=null){if($charlist===null){return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}]+|[\s\x{FEFF}\x{200B}\x{200E}]+$~u','',$value)?? \trim($value);}return \trim($value,$charlist);}
    }}