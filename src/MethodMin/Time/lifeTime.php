<?php

namespace Inilim\Tool\Method\Time;

function lifeTime($ttl,int $default=3600){if($ttl===null){return $default;}elseif(\is_int($ttl)){return $ttl;}return(new \DateTime())-> add($ttl)-> getTimestamp()-\time();}