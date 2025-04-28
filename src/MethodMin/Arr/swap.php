<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr{function swap(){if(\func_num_args()!==0){throw new \InvalidArgumentException('swap()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,$keyOne,$keyTwo){if(!\Inilim\Tool\Method\Arr\exists($array,$keyOne)||!\Inilim\Tool\Method\Arr\exists($array,$keyTwo)){throw new \InvalidArgumentException('One or both keys do not exist in the array.');}if($keyOne===$keyTwo){return;}[$array[$keyOne],$array[$keyTwo]]=[$array[$keyTwo],$array[$keyOne]];};}if(!\Inilim\Tool\Arr::__definedIfNot('exists')){
    function exists($array,$key){if($array instanceof \ArrayAccess){return $array -> offsetExists($key);}return \array_key_exists($key,$array);}
    }}