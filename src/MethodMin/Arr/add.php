<?php

namespace Inilim\Tool\Method\Arr;

function add(array $array,string $key,$value){if(\Inilim\Tool\Arr :: get($array,$key)===null){\Inilim\Tool\Arr :: set($array,$key,$value);}return $array;}