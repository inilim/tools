<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Integer;

function clamp($number,$min,$max){return \min(\max($number,$min),$max);}