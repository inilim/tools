<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Integer;

function __compare(array $value,array $arrayInt):bool{foreach(\array_map(null,$value,$arrayInt)as $c){list($v,$a)=$c;$v=\intval($v);if($v>$a){return false;}elseif($v<$a){return true;}}return true;}