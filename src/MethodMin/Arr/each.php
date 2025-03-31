<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function each($array,callable $callback){foreach($array as $key=>$item){if($callback($item,$key)===false){break;}}}