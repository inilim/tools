<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF{function array_last(array $array){if(\Inilim\Tool\Method\Check\php85()){return \array_last($array);}if($array===[]){return null;}return \end($array);}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php85')){
    function php85():bool{return \PHP_VERSION_ID>=80500?true:false;}
    }}