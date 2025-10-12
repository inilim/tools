<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Data{function magicMethodsAsArray(){return \Inilim\Tool\Method\Data\magicMethodsAsClosure()-> __invoke();}if(!\Inilim\Tool\Data::__definedIfNot('magicMethodsAsClosure')){
    function magicMethodsAsClosure(){return static fn()=>['__construct','__destruct','__call','__callStatic','__get','__set','__isset','__unset','__sleep','__wakeup','__serialize','__unserialize','__toString','__invoke','__set_state','__clone','__debugInfo'];}
    }}