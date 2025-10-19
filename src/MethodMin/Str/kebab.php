<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str{function kebab(string $value):string{return \Inilim\Tool\Method\Str\snake($value,'-');}if(!\Inilim\Tool\Str::__definedIfNot('lower')){
    function lower(string $value,?string $encoding='UTF-8'){return \mb_strtolower($value,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('snake')){
    function snake(string $value,string $delimiter='_'):string{if(!\Inilim\Tool\Method\PF\ctype_lower($value)){$modeU=\Inilim\Tool\Method\Check\php80()?'u':'';$value=\preg_replace('/\s+/'.$modeU,'',\ucwords($value));$value=\Inilim\Tool\Method\Str\lower(\preg_replace('/(.)(?=[A-Z])/'.$modeU,'$1'.$delimiter,$value));}return $value;}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('__resource')){
    function __resource(string $class,string $name){$_class=\basename(\dirname(\strtr($class,'\\','/')));$name=\sprintf('%s/../../../files/resources/%s/%s.php',__DIR__,$_class,$name);if(\is_file($name)){return require $name;}return null;}
    }if(!\Inilim\Tool\Other::__definedIfNot('__resourceCache')){
    function __resourceCache(string $class,string $name){static $o=null;$o ??=[];$_class=\basename(\dirname(\strtr($class,'\\','/')));$o[$_class]??=[];if(\array_key_exists($name,$o[$_class])){return $o[$_class][$name];}return $o[$_class][$name]=\Inilim\Tool\Method\Other\__resource($class,$name);}
    }if(!\Inilim\Tool\Other::__definedIfNot('funcPhp')){
    function funcPhp(string $function,bool $rechecking=false):bool{static $o=null;$o ??=[];$function=\ltrim($function,'\\');if(isset($o[$function])&&!$rechecking){return $o[$function];}return $o[$function]=\function_exists($function);}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('ctype_lower')){
    function ctype_lower($text):bool{if(\Inilim\Tool\Method\Other\funcPhp('ctype_lower')){return \ctype_lower($text);}$cls=\Inilim\Tool\Method\Other\__resourceCache(__FUNCTION__,'convert_int_to_char_for_ctype');$text=$cls -> __invoke($text,'ctype_lower');return \is_string($text)&&''!==$text&&!\preg_match('/[^a-z]/',$text);}
    }}