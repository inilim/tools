<?php

namespace Inilim\Tool\Method\LarArr{function toCssClasses($array){$classList=\Inilim\Tool\Method\LarArr\wrap($array);$classes=[];foreach($classList as $class=>$constraint){if(\is_numeric($class)){$classes[]=$constraint;}elseif($constraint){$classes[]=$class;}}return \implode(' ',$classes);}if(!\Inilim\Tool\LarArr::__definedIfNot('wrap')){
    function wrap($value){if(\is_null($value)){return[];}return \is_array($value)?$value:[$value];}
    }}