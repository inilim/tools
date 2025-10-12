<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other{function instanceOfAll(object $obj,... $classes):bool{return \Inilim\Tool\Method\Other\instanceOfAllArray($obj,$classes);}if(!\Inilim\Tool\Other::__definedIfNot('instanceOfAllArray')){
    function instanceOfAllArray(object $obj,array $classes):bool{foreach($classes as $class){$class=\is_object($class)?\get_class($class):$class;if(!\is_a($obj,$class)){return false;}}return true;}
    }}