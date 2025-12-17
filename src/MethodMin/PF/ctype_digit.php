<?php

declare(strict_types=1);namespace Inilim\Tool\Method\PF{function ctype_digit($text):bool{if(\Inilim\Tool\Method\Other\funcPhp('ctype_digit')){return \ctype_digit($text);}$cls=\Inilim\Tool\Method\Other\__resourceCache(__FUNCTION__,'convert_int_to_char_for_ctype');$text=$cls -> __invoke($text,'ctype_digit');return \is_string($text)&&''!==$text&&!\preg_match('/[^0-9]/',$text);}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('__resource')){
    function __resource(string $namespace,string $name){$class=\basename(\dirname(\strtr($namespace,'\\','/')));$name=\sprintf('%s/../../../files/resources/%s/%s.php',__DIR__,$class,$name);if(\is_file($name)){return require $name;}return null;}
    }if(!\Inilim\Tool\Other::__definedIfNot('__resourceCache')){
    function __resourceCache(string $namespace,string $name){static $o=null;$o ??=[];$class=\basename(\dirname(\strtr($namespace,'\\','/')));$o[$class]??=[];if(\array_key_exists($name,$o[$class])){return $o[$class][$name];}return $o[$class][$name]=\Inilim\Tool\Method\Other\__resource($namespace,$name);}
    }if(!\Inilim\Tool\Other::__definedIfNot('funcPhp')){
    function funcPhp(string $function,bool $rechecking=false):bool{static $o=null;$o ??=[];$function=\ltrim($function,'\\');if(isset($o[$function])&&!$rechecking){return $o[$function];}return $o[$function]=\function_exists($function);}
    }}