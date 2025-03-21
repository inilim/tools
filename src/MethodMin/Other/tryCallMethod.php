<?php

namespace Inilim\Tool\Method\Other{function tryCallMethod($objectOrClass,string $methodName,array $args=[],$default=null){return \Inilim\Tool\Method\Other\tryCallCallable([$objectOrClass,$methodName],$args,$default);}if(!\Inilim\Tool\Other::__definedIfNot('tryCallCallable')){
    function tryCallCallable(callable $callable,array $args=[],$default=null){try{$result=\call_user_func_array($callable,$args);}catch(\Throwable $e){return['result'=>$default,'exception'=>$e];}return['result'=>$result,'exception'=>null];}
    }}