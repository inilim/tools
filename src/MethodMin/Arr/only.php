<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function only(array $array,$keys):array{return \array_intersect_key($array,\array_flip((array) $keys));}