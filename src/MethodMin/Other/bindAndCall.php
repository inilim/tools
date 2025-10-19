<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other{function bindAndCall(object $object,\Closure $callback,... $args){$result=$callback -> bindTo($object,$object)-> __invoke(... $args);\Inilim\Tool\Method\Other\clearClosure($callback);return $result;}if(!\Inilim\Tool\Other::__definedIfNot('clearClosure')){
    function clearClosure(\Closure $cls){return $cls -> bindTo(null,null);}
    }}