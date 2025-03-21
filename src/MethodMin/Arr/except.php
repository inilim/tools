<?php

namespace Inilim\Tool\Method\Arr;

function except(array $array,$keys){\Inilim\Tool\Arr :: forget($array,$keys);return $array;}