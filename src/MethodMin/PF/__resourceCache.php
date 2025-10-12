<?php

declare(strict_types=1);namespace Inilim\Tool\Method\PF{function __resourceCache(string $name){static $o=null;$o ??=[];if(\array_key_exists($name,$o)){return $o[$name];}return $o[$name]=\Inilim\Tool\Method\PF\__resource($name);}if(!\Inilim\Tool\PF::__definedIfNot('__resource')){
    function __resource(string $name){if(\is_file($name=__DIR__.'/../../../files/resources/PF/'.$name.'.php')){return require $name;}return null;}
    }}