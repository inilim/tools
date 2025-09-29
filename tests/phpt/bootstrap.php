<?php

require_once __DIR__ . '/../../vendor/autoload.php';

define('ABSROOT', __DIR__);

\date_default_timezone_set('UTC');
\ini_set('display_errors', 1);
\ini_set('memory_limit', '5M');
\error_reporting(\E_ALL);
\set_time_limit(5);
