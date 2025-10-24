<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Exp{function isResObjJsonSqlite($value):bool{if(!\is_object($value)||!\Inilim\Tool\Method\PF\str_starts_with(\get_class($value),'class@anonymous')){return false;}return \Inilim\Tool\Method\Other\bindAndCall($value,function(){return($this -> tag ?? '')===\Inilim\Tool\Method\Exp\__tagJsonSqlite();});}if(!\Inilim\Tool\Exp::__definedIfNot('__tagJsonSqlite')){
    function __tagJsonSqlite():string{return 'open-file-json-sqlite';}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('bindAndCall')){
    function bindAndCall(object $object,\Closure $callback,... $args){$result=$callback -> bindTo($object,$object)-> __invoke(... $args);\Inilim\Tool\Method\Other\clearClosure($callback);return $result;}
    }if(!\Inilim\Tool\Other::__definedIfNot('clearClosure')){
    function clearClosure(\Closure $cls){return $cls -> bindTo(null,null);}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_starts_with')){
    function str_starts_with(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_starts_with($haystack,$needle);}return 0===\strncmp($haystack,$needle,\strlen($needle));}
    }}