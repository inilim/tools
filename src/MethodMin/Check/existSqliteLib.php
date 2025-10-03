<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Check{function existSqliteLib():bool{return \Inilim\Tool\Method\Other\sqliteLibVersion()!==null;}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('sqliteLibVersion')){
    function sqliteLibVersion():?string{\ob_start();\phpinfo(\INFO_MODULES);$pinfo=\ob_get_clean();\preg_match('/SQLite\s+Library\s+=>\s+(\d+\.\d+\.?\d+?)/i',$pinfo,$match);return $match[1]?? null;}
    }}