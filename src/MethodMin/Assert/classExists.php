<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Assert{function classExists($value,string $message=''){if(!\class_exists($value)){throw new \InvalidArgumentException(\sprintf($message?:'Expected an existing class name. Got: %s',\Inilim\Tool\Method\Other\valueToString($value)));}}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('funcPhp')){
    function funcPhp(string $function,bool $rechecking=false):bool{static $o=null;$o ??=[];$function=\ltrim($function,'\\');if(isset($o[$function])&&!$rechecking){return $o[$function];}return $o[$function]=\function_exists($function);}
    }if(!\Inilim\Tool\Other::__definedIfNot('valueToString')){
    function valueToString($value):string{if(null===$value){return 'null';}if(true===$value){return 'true';}if(false===$value){return 'false';}if(\is_array($value)){return 'array';}if(\is_object($value)){if(\method_exists($value,'__toString')){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> __toString());}if($value instanceof \DateTime||$value instanceof \DateTimeImmutable){return \get_class($value).': '.\Inilim\Tool\Method\Other\valueToString($value -> format('c'));}if(\Inilim\Tool\Method\Other\funcPhp('enum_exists')&&\enum_exists(\get_class($value))){return \get_class($value).'::'.$value -> name;}return \get_class($value);}if(\is_resource($value)){return 'resource';}if(\is_string($value)){return '"'.$value.'"';}return (string) $value;}
    }}