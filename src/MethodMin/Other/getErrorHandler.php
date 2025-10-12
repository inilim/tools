<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function getErrorHandler(){$callable=\set_error_handler(static fn()=>true);\restore_error_handler();return $callable;}