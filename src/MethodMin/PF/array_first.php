<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\PF{function array_first(array $array){if(\Inilim\Tool\Method\Check\php85()){return \array_first($array);}foreach($array as $value){return $value;}return null;}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php85')){
    function php85():bool{return \PHP_VERSION_ID>=80500?true:false;}
    }}