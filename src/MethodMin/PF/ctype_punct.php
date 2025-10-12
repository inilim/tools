<?php

declare(strict_types=1);namespace Inilim\Tool\Method\PF{function ctype_punct($text):bool{if(\Inilim\Tool\Method\Other\funcPhp('ctype_punct')){return \ctype_punct($text);}$cls=\Inilim\Tool\Method\PF\__resourceCache('convert_int_to_char_for_ctype');$text=$cls -> __invoke($text,'ctype_punct');return \is_string($text)&&''!==$text&&!\preg_match('/[^!-\/\:-@\[-`\{-~]/',$text);}if(!\Inilim\Tool\PF::__definedIfNot('__resource')){
    function __resource(string $name){if(\is_file($name=__DIR__.'/../../../files/resources/PF/'.$name.'.php')){return require $name;}return null;}
    }if(!\Inilim\Tool\PF::__definedIfNot('__resourceCache')){
    function __resourceCache(string $name){static $o=null;$o ??=[];if(\array_key_exists($name,$o)){return $o[$name];}return $o[$name]=\Inilim\Tool\Method\PF\__resource($name);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('funcPhp')){
    function funcPhp(string $function,bool $rechecking=false):bool{static $o=null;$o ??=[];$function=\ltrim($function,'\\');if(isset($o[$function])&&!$rechecking){return $o[$function];}return $o[$function]=\function_exists($function);}
    }}