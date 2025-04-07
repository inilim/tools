<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Refl;

function _class($classOrObj,bool $throw=false){try{return new \ReflectionClass($classOrObj);}catch(\ReflectionException $e){return $throw?throw $e:null;}}