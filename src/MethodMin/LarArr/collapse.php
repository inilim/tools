<?php

namespace Inilim\Tool\Method\LarArr;

function collapse($array){$results=[];foreach($array as $values){if($values instanceof \Traversable){$values=\iterator_to_array($values);}elseif(is_array($values)){$results[]=$values;}}return \array_merge([],... $results);}