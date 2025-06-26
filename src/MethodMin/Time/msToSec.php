<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

function msToSec(int $ms):int{return \intval($ms*0.001);}