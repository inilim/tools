<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Exp;

function vec_binVecToArray(string $vector):array{return \array_values(\unpack('f*',$vector));}