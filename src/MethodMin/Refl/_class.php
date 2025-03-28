<?php

namespace Inilim\Tool\Method\Refl;

function _class($objectOrClass,bool $throw=false){try{return new \ReflectionClass($objectOrClass);}catch(\ReflectionException $e){return $throw?throw $e:null;}}