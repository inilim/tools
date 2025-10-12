<?php

namespace Inilim\Tool\Method\LarArr;

function partition($array,callable $callback){$passed=[];$failed=[];foreach($array as $key=>$item){if($callback($item,$key)){$passed[$key]=$item;}else{$failed[$key]=$item;}}return[$passed,$failed];}