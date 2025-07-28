<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other{function tryCallCallable(callable $callable,array $args=[],$default=null){try{$result=\call_user_func_array($callable,$args);}catch(\Throwable $e){return \Inilim\Tool\Method\Other\_refDots(['result'=>$default,'exception'=>$e]);}return \Inilim\Tool\Method\Other\_refDots(['result'=>$result,'exception'=>null]);}if(!\Inilim\Tool\Other::__definedIfNot('_refDots')){
    function _refDots(array $array):array{$dots=[];foreach($array as&$value){$dots[]=&$value;}$array['...']=$dots;return $array;}
    }}