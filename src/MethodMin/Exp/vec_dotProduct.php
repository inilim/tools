<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Exp;

function vec_dotProduct(array $vectorA,array $vectorB):float{$dotProduct=0.0;foreach($vectorA as $i=>$vector){$dotProduct += $vector*$vectorB[$i];}return $dotProduct;}