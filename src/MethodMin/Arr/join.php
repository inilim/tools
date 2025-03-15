<?php

namespace Inilim\Tool\Method\Arr;

function join(array $array,string $glue,string $finalGlue=''):string{if($finalGlue===''){return \implode($glue,$array);}if(!$array){return '';}if(\sizeof($array)===1){return \end($array);}$finalItem=\array_pop($array);return \implode($glue,$array).$finalGlue.$finalItem;}