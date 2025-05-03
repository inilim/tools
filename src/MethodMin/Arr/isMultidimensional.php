<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function isMultidimensional(array $array):bool{return \sizeof(\array_filter($array,'is_array'))>0;}