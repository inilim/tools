<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function phpRuntimeFingerprint():string{$scanned=\php_ini_scanned_files();return \sha1(\implode('|',[\PHP_SAPI,\PHP_BINARY,\PHP_VERSION_ID,(string) \php_ini_loaded_file(),false===$scanned?'':$scanned]),false);}