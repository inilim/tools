<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Time;

function sleepMilSecs(int $v){\usleep(1000*$v);}