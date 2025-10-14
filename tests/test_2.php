<?php

set_error_handler(static function () {
    print_r(func_get_args());
});

\bcdiv('1', '0', 0);

// $a = new \DivisionByZeroError;
// print_r($a);
