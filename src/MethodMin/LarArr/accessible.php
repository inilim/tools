<?php

namespace Inilim\Tool\Method\LarArr;

function accessible($value):bool{return \is_array($value)||$value instanceof \ArrayAccess;}