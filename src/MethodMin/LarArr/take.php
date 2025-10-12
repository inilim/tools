<?php

namespace Inilim\Tool\Method\LarArr;

function take($array,$limit){if($limit<0){return \array_slice($array,$limit,\abs($limit));}return \array_slice($array,0,$limit);}