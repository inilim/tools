<?php

namespace Inilim\Tool\Method\Arr;

function partition(iterable $array,callable $callback){$passed=[];$failed=[];foreach($array as $key=>&$item){$t=$item;if($callback($t,$key)){$passed[$key]=$item;}else{$failed[$key]=$item;}}return[$passed,$failed];}