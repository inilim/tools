<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Other;

function backtrace(int $limit=0,int $reset=0,int $flags=\DEBUG_BACKTRACE_IGNORE_ARGS,bool $reverse=true){$reset++;if($limit!==0){$limit++;}$stack=\debug_backtrace($flags,$limit);$result=[];foreach($stack as $idx=>&$item){if($reset>0){$reset--;unset($stack[$idx]);continue;}$result[]=['file'=>$item['file']?? null,'line'=>$item['line']?? null,'method'=>$item['function']?? null,'type'=>$item['type']?? null,'class'=>$item['class']?? null,'object'=>$item['object']?? null,'args'=>$item['args']?? null];unset($stack[$idx]);}if($reverse){return \array_reverse($result);}return $result;}