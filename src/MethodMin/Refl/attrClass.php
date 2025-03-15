<?php

namespace Inilim\Tool\Method\Refl{function attrClass($classOrObjOrRef,bool $throw=false){if(\PHP_VERSION_ID<80000){return null;}if($classOrObjOrRef instanceof \ReflectionClass){$ref=$classOrObjOrRef;}else{$ref=\Inilim\Tool\Method\Refl\_class($classOrObjOrRef,$throw);}if($ref===null){return null;}return $ref -> getAttributes();}if(!\Inilim\Tool\Refl::__definedIfNot('_class')){
    function _class($objectOrClass,bool $throw=false){if(\is_string($objectOrClass)){if(!\class_exists($objectOrClass)){return $throw?throw new \ReflectionException('class not found '.$objectOrClass):null;}}elseif($objectOrClass instanceof \ReflectionClass){return $objectOrClass;}return new \ReflectionClass($objectOrClass);}
    }}