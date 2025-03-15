<?php

namespace Inilim\Tool\Method\Arr;

function shuffle(array $array,?int $seed=null,bool $preserveKeys=true){if($seed!==null){\mt_srand($seed);}if($preserveKeys){$keys=\array_keys($array);\shuffle($keys);$result=[];foreach($keys as $key){$result[$key]=$array[$key];}}else{\shuffle($array);$result=$array;}if($seed!==null){\mt_srand();/*// Сброс seed, чтобы не влиять на другие вызовы*/}return $result;}