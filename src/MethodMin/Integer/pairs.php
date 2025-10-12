<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Integer;

function pairs($to,$by,$start=0,$offset=1):array{$output=[];for($lower=$start;$lower<$to;$lower += $by){$upper=$lower+$by-$offset;if($upper>$to){$upper=$to;}$output[]=[$lower,$upper];}return $output;}