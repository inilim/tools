<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str;

function translatePhpUrlConstantToKey(int $constant):string{if($constant===\PHP_URL_SCHEME){$r='protocol';}elseif($constant===\PHP_URL_HOST){$r='domain';}elseif($constant===\PHP_URL_PORT){$r='port';}elseif($constant===\PHP_URL_USER){$r='login';}elseif($constant===\PHP_URL_PASS){$r='password';}elseif($constant===\PHP_URL_PATH){$r='path';}elseif($constant===\PHP_URL_QUERY){$r='query';}elseif($constant===\PHP_URL_FRAGMENT){$r='anchor';}else{$r='';}return $r;}