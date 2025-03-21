<?php

namespace Inilim\Tool\Method\Arr;

function hasAny($array,$keys){if($keys===null){return false;}$keys=(array) $keys;if(!$array){return false;}if($keys===[]){return false;}foreach($keys as $key){if(\Inilim\Tool\Arr :: has($array,$key)){return true;}}return false;}