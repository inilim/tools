<?php

namespace Inilim\Tool\Method\LarArr;

function wrap($value){if(\is_null($value)){return[];}return \is_array($value)?$value:[$value];}