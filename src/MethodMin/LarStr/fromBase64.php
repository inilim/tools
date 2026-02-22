<?php

namespace Inilim\Tool\Method\LarStr;

function fromBase64($string,$strict=false){return \base64_decode($string,$strict);}