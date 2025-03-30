<?php

namespace Inilim\Tool\Method\Arr;

function where(array $array,callable $callback,bool $preserveKeys=true):array{$result=\array_filter($array,$callback,\ARRAY_FILTER_USE_BOTH);return $preserveKeys?$result:\array_values($result);}