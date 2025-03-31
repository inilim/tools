<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other{function toCssStyles(array $array){$styles=[];foreach($array as $class=>&$constraint){if(\is_numeric($class)){$styles[]=\Inilim\Tool\Method\Str\finish($constraint,';');}elseif($constraint){$styles[]=\Inilim\Tool\Method\Str\finish($class,';');}}return \implode(' ',$styles);}}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('finish')){
    function finish(string $value,string $cap):string{return \preg_replace('/(?:'.\preg_quote($cap,'/').')+$/u','',$value).$cap;}
    }}