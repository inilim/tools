<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check{function intOrFloatOrFile($value):bool{return \Inilim\Tool\Method\Check\intOrFloat($value)||\Inilim\Tool\Method\Check\file($value);}if(!\Inilim\Tool\Check::__definedIfNot('file')){
    function file($value):bool{return \is_string($value)&&\is_file($value);}
    }if(!\Inilim\Tool\Check::__definedIfNot('intOrFloat')){
    function intOrFloat($value):bool{return \is_int($value)||\is_float($value);}
    }}