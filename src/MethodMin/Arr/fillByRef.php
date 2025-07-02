<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function fillByRef():\Closure{if(\func_num_args()!==0){throw new \InvalidArgumentException('fillByRef()(...) <-- The arguments were passed to the wrong place');}return static function(array&$array,int $count,$value){for($i=0;$i<$count;$i++){$array[]=$value;}};}