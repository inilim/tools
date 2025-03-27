<?php

namespace Inilim\Tool\Method\Refl{function getProp($object,string $name,bool $throw=false){if($object instanceof \ReflectionClass){$ref=$object;}else{$ref=\Inilim\Tool\Method\Refl\_class($object,$throw);if($ref===null){return null;}}try{return $ref -> getProperty($name);}catch(\ReflectionException $e){return $throw?throw $e:null;}}if(!\Inilim\Tool\Refl::__definedIfNot('_class')){
    function _class($objectOrClass,bool $throw=false){if(\is_string($objectOrClass)){if(!\class_exists($objectOrClass)){return $throw?throw new \ReflectionException('class not found '.$objectOrClass):null;}}elseif($objectOrClass instanceof \ReflectionClass){return $objectOrClass;}return new \ReflectionClass($objectOrClass);}
    }}