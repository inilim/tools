<?php

namespace Inilim\Tool\Method\LarArr;

function only($array,$keys){return \array_intersect_key($array,\array_flip((array) $keys));}