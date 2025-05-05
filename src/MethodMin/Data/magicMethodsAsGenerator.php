<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Data;

function magicMethodsAsGenerator():\Generator{yield '__construct';yield '__destruct';yield '__call';yield '__callStatic';yield '__get';yield '__set';yield '__isset';yield '__unset';yield '__sleep';yield '__wakeup';yield '__serialize';yield '__unserialize';yield '__toString';yield '__invoke';yield '__set_state';yield '__clone';yield '__debugInfo';}