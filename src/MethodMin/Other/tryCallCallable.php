<?php

namespace Inilim\Tool\Method\Other;

function tryCallCallable(callable $callable,array $args=[],$default=null){try{$result=\call_user_func_array($callable,$args);}catch(\Throwable $e){return['result'=>$default,'exception'=>$e];}return['result'=>$result,'exception'=>null];}