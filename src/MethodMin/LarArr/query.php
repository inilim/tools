<?php

namespace Inilim\Tool\Method\LarArr;

function query($array){return \http_build_query($array,'','&',\PHP_QUERY_RFC3986);}