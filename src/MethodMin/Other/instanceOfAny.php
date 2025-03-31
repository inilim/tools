<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other{function instanceOfAny(object $obj,... $classes){return \Inilim\Tool\Method\Other\instanceOfAnyArray($obj,$classes);}if(!\Inilim\Tool\Other::__definedIfNot('instanceOfAnyArray')){
    function instanceOfAnyArray(object $obj,array $classes){foreach($classes as $class){$class=\is_object($class)?\get_class($class):$class;if(\is_a($obj,$class)){return true;}}return false;}
    }}