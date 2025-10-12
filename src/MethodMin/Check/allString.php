<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check{function allString($value):bool{if(!\Inilim\Tool\Method\Check\isIterable($value)){return false;}foreach($value as $item){if(!\is_string($item)){return false;}}return true;}if(!\Inilim\Tool\Check::__definedIfNot('isIterable')){
    function isIterable($value):bool{return \is_array($value)||$value instanceof \Traversable;}
    }}