<?php

namespace Inilim\Tool\Method\String;

function __state(){static $o=null;return $o ?? new class{var $randomStringFactory;};}