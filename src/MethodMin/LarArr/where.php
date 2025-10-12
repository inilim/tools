<?php

namespace Inilim\Tool\Method\LarArr;

function where($array,callable $callback){return \array_filter($array,$callback,\ARRAY_FILTER_USE_BOTH);}