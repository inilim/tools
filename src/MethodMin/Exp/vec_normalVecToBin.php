<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Exp;

function vec_normalVecToBin(array $vector):string{return \pack('f*',... $vector);}