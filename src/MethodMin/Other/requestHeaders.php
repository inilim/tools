<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

function requestHeaders(?array $_server=null){$headers=[];if($_server===null&&\function_exists('getallheaders')){$headers=\getallheaders();if($headers!==false){return \array_change_key_case($headers,\CASE_UPPER);}}foreach($_server ?? $_SERVER as $name=>$value){if(($http=\stripos($name,'HTTP_')===0)||$name=='CONTENT_TYPE'||$name=='CONTENT_LENGTH'||$name=='content_type'||$name=='content_length'){if($http){$name=\substr($name,5);}$name=\strtr($name,'_','-');$headers[$name]=$value;}}return \array_change_key_case($headers,\CASE_UPPER);}