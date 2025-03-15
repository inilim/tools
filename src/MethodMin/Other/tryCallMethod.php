<?php

namespace Inilim\Tool\Method\Other{function tryCallMethod($objectOrClass,string $methodName,array $args=[],$default=null,?\Throwable&$exception=null){return \Inilim\Tool\Method\Other\tryCallCallable([$objectOrClass,$methodName],$args,$default,$exception);}if(!\Inilim\Tool\Other::__definedIfNot('tryCallCallable')){
    function tryCallCallable($callable,array $args=[],$default=null,?\Throwable&$exception=null){try{if(!\is_callable($callable)){throw new \Exception('$callable give not callable');}$result=\call_user_func($callable,... $args);}catch(\Throwable $e){$exception=$e;return $default;}return $result;}
    }}