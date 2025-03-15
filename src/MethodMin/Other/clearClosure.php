<?php

namespace Inilim\Tool\Method\Other;

function clearClosure(\Closure $cls){return $cls -> bindTo(null,null);}