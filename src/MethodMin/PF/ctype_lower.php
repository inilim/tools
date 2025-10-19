<?php

declare(strict_types=1);namespace Inilim\Tool\Method\PF{function ctype_lower($text):bool{if(\Inilim\Tool\Method\Other\funcPhp('ctype_lower')){return \ctype_lower($text);}$cls=\Inilim\Tool\Method\Other\__resourceCache(__FUNCTION__,'convert_int_to_char_for_ctype');$text=$cls -> __invoke($text,'ctype_lower');return \is_string($text)&&''!==$text&&!\preg_match('/[^a-z]/',$text);}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('__resource')){
    function __resource(string $class,string $name){$_class=\basename(\dirname(\strtr($class,'\\','/')));$name=\sprintf('%s/../../../files/resources/%s/%s.php',__DIR__,$_class,$name);if(\is_file($name)){return require $name;}return null;}
    }if(!\Inilim\Tool\Other::__definedIfNot('__resourceCache')){
    function __resourceCache(string $class,string $name){static $o=null;$o ??=[];$_class=\basename(\dirname(\strtr($class,'\\','/')));$o[$_class]??=[];if(\array_key_exists($name,$o[$_class])){return $o[$_class][$name];}return $o[$_class][$name]=\Inilim\Tool\Method\Other\__resource($class,$name);}
    }if(!\Inilim\Tool\Other::__definedIfNot('funcPhp')){
    function funcPhp(string $function,bool $rechecking=false):bool{static $o=null;$o ??=[];$function=\ltrim($function,'\\');if(isset($o[$function])&&!$rechecking){return $o[$function];}return $o[$function]=\function_exists($function);}
    }}