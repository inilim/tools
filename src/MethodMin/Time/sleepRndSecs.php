<?php

namespace Inilim\Tool\Method\Time;

function sleepRndSecs(int $min,int $max){\sleep(\mt_rand($min,$max));}