<?php

namespace Inilim\Tool\Method\Other{function toCssClasses(array $array):string{$classList=\Inilim\Tool\Method\LarArr\wrap($array);$classes=[];foreach($classList as $class=>$constraint){if(\is_numeric($class)){$classes[]=$constraint;}elseif($constraint){$classes[]=$class;}}return \implode(' ',$classes);}}namespace Inilim\Tool\Method\LarArr{if(!\Inilim\Tool\LarArr::__definedIfNot('wrap')){
    function wrap($value){if(\is_null($value)){return[];}return \is_array($value)?$value:[$value];}
    }}