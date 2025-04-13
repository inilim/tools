<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function createRandomStringsUsing(?callable $factory=null){\Inilim\Tool\Method\Str\__state()-> randomStringFactory=$factory;}if(!\Inilim\Tool\Str::__definedIfNot('__state')){
    function __state(){static $o=null;return $o ?? new class{var $randomStringFactory;var $internalEncoding='UTF-8';function getEncoding($encoding){if(null===$encoding){return $this -> internalEncoding;}if('UTF-8'===$encoding){return 'UTF-8';}$encoding=\strtoupper($encoding);if('8BIT'===$encoding||'BINARY'===$encoding){return 'CP850';}if('UTF8'===$encoding){return 'UTF-8';}return $encoding;}};}
    }}