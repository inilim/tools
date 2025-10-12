<?php

declare(strict_types=1);namespace Inilim\Tool\Method\PF{function get_error_handler():?callable{if(\Inilim\Tool\Method\Check\php85()){return \get_error_handler();}$handler=\set_error_handler(null);\restore_error_handler();return $handler;}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php85')){
    function php85():bool{return \PHP_VERSION_ID>=80500?true:false;}
    }}