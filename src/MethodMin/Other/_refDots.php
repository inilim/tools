<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

function _refDots(array $array):array{$dots=[];foreach($array as&$value){$dots[]=&$value;}$array['...']=$dots;return $array;}