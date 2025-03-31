<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Arr;

function whereNotNull(array $array,bool $preserveKeys=true){$result=\array_filter($array,static fn($v)=>$v!==null);return $preserveKeys?$result:\array_values($result);}