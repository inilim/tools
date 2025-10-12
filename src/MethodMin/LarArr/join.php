<?php

declare(strict_types=1);namespace Inilim\Tool\Method\LarArr{function join($array,$glue,$finalGlue=''){if($finalGlue===''){return \implode($glue,$array);}if(\count($array)===0){return '';}if(\count($array)===1){return \Inilim\Tool\Method\PF\array_last($array);}$finalItem=\array_pop($array);return \implode($glue,$array).$finalGlue.$finalItem;}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php85')){
    function php85():bool{return \PHP_VERSION_ID>=80500?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('array_last')){
    function array_last(array $array){if(\Inilim\Tool\Method\Check\php85()){return \array_last($array);}return $array?\current(\array_slice($array,-1)):null;}
    }}