<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other{function __resourceCache(string $namespace,string $name){static $o=null;$o ??=[];$class=\basename(\dirname(\strtr($namespace,'\\','/')));$o[$class]??=[];if(\array_key_exists($name,$o[$class])){return $o[$class][$name];}return $o[$class][$name]=\Inilim\Tool\Method\Other\__resource($namespace,$name);}if(!\Inilim\Tool\Other::__definedIfNot('__resource')){
    function __resource(string $namespace,string $name){$class=\basename(\dirname(\strtr($namespace,'\\','/')));$name=\sprintf('%s/../../../files/resources/%s/%s.php',__DIR__,$class,$name);if(\is_file($name)){return require $name;}return null;}
    }}