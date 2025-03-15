<?php

namespace Inilim\Tool\Method\Json;

function getLastError(){return['code'=>\json_last_error(),'msg'=>\json_last_error_msg()];}