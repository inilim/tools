<?php

namespace Inilim\Tool\Method\LarArr;

function exceptValues($array,$values,$strict=false){$values=(array) $values;return \array_filter($array,static function($value)use($values,$strict){return!\in_array($value,$values,$strict);});}