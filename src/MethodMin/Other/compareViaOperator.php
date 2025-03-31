<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

function compareViaOperator($left,string $operator,$right){switch($operator){case '>':return $left>$right;case '>=':return $left>=$right;case '<':return $left<$right;case '<=':return $left<=$right;case '=':case '==':return $left==$right;case '===':return $left===$right;case '!=':case '<>':return $left!=$right;case '!==':return $left!==$right;}throw new \InvalidArgumentException("Unknown operator '{$operator}'");}