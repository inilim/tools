<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other{function toCssClasses(array $array):string{$classList=\Inilim\Tool\Method\Arr\wrap($array);$classes=[];foreach($classList as $class=>$constraint){if(\is_numeric($class)){$classes[]=$constraint;}elseif($constraint){$classes[]=$class;}}return \implode(' ',$classes);}}namespace Inilim\Tool\Method\Arr{if(!\Inilim\Tool\Arr::__definedIfNot('wrap')){
    function wrap($value):array{return \is_array($value)?$value:[$value];}
    }}