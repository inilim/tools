<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Exp;

function vec_normalize(array $vector):array{$sum=0.0;foreach($vector as $val){$sum += $val*$val;}$norm=\sqrt($sum);if($norm==0.0){$norm=1.0;}$inv=1.0/$norm;foreach($vector as $i=>$val){$vector[$i]*= $inv;}return[$vector,$norm];}