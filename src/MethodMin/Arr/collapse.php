<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function collapse(iterable $array){$results=[];foreach($array as $values){if(!\is_array($values)){continue;}$results[]=$values;}return \array_merge([],... $results);}