<?php

namespace Inilim\Tool\Method\Arr{function renameKey(array&$array,$oldKey,$newKey){$offset=\Inilim\Tool\Method\Arr\getKeyOffset($array,$oldKey);if($offset===null){return false;}$val=&$array[$oldKey];$keys=\array_keys($array);$keys[$offset]=$newKey;$array=\array_combine($keys,$array);$array[$newKey]=&$val;return true;}if(!\Inilim\Tool\Arr::__definedIfNot('getKeyOffset')){
    function getKeyOffset(array $array,$key){$value=\array_search(\key([$key=>null]),\array_keys($array),true);return $value===false?null:$value;}
    }}