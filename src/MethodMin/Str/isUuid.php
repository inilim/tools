<?php

namespace Inilim\Tool\Method\Str;

function isUuid($value){if(PHP_VERSION_ID>=80000&&\is_object($value)&&$value instanceof \Stringable){$value=$value -> __toString();}if(!\is_string($value)){return false;}return \preg_match('/^[\da-f]{8}-[\da-f]{4}-[\da-f]{4}-[\da-f]{4}-[\da-f]{12}$/iD',$value)>0;}