<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other{function __resourceCache(string $class,string $name){static $o=null;$o ??=[];$_class=\basename(\dirname(\strtr($class,'\\','/')));$o[$_class]??=[];if(\array_key_exists($name,$o[$_class])){return $o[$_class][$name];}return $o[$_class][$name]=\Inilim\Tool\Method\Other\__resource($class,$name);}if(!\Inilim\Tool\Other::__definedIfNot('__resource')){
    function __resource(string $class,string $name){$_class=\basename(\dirname(\strtr($class,'\\','/')));$name=\sprintf('%s/../../../files/resources/%s/%s.php',__DIR__,$_class,$name);if(\is_file($name)){return require $name;}return null;}
    }}