<?php

namespace Inilim\Tool\Method\Other{function clearClosureRef(\Closure&$cls){$cls=\Inilim\Tool\Method\Other\clearClosure($cls);}if(!\Inilim\Tool\Other::__definedIfNot('clearClosure')){
    function clearClosure(\Closure $cls){return $cls -> bindTo(null,null);}
    }}