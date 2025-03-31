<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function parseUrl(string $url){$r=\parse_url($url);if(!\is_array($r)){$r=[];}return['count_element'=>\sizeof($r),'raw'=>$url,'scheme'=>$r['scheme']?? null,'login'=>$r['user']?? null,'password'=>$r['pass']?? null,'host'=>$r['host']?? null,'port'=>$r['port']?? null,'path'=>$r['path']?? null,'query'=>$r['query']?? null,'anchor'=>$r['fragment']?? null];}