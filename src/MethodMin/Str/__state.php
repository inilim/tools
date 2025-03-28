<?php

namespace Inilim\Tool\Method\Str;

function __state(){static $o=null;return $o ?? new class{var $randomStringFactory;};}