<?php

namespace Inilim\Tool\Method\LarArr{function toCssStyles($array){$styleList=\Inilim\Tool\Method\LarArr\wrap($array);$styles=[];foreach($styleList as $class=>$constraint){if(\is_numeric($class)){$styles[]=\Inilim\Tool\Method\LarStr\finish($constraint,';');}elseif($constraint){$styles[]=\Inilim\Tool\Method\LarStr\finish($class,';');}}return \implode(' ',$styles);}if(!\Inilim\Tool\LarArr::__definedIfNot('wrap')){
    function wrap($value){if(\is_null($value)){return[];}return \is_array($value)?$value:[$value];}
    }}namespace Inilim\Tool\Method\LarStr{if(!\Inilim\Tool\LarStr::__definedIfNot('finish')){
    function finish($value,$cap){$quoted=\preg_quote($cap,'/');return \preg_replace('/(?:'.$quoted.')+$/u','',$value).$cap;}
    }}