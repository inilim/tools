<?php

namespace Inilim\Tool\Method\LarArr;

function accessible($value){return \is_array($value)||$value instanceof \ArrayAccess;}