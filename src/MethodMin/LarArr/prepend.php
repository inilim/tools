<?php

namespace Inilim\Tool\Method\LarArr;

function prepend($array,$value,$key=null){if(\func_num_args()==2){\array_unshift($array,$value);}else{$array=[$key=>$value]+$array;}return $array;}