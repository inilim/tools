<?php

namespace Inilim\Tool\Method\Arr;

function value($value){return $value instanceof \Closure?$value():$value;}