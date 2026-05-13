<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Exp{function vec_cosineSimilarityBin(string $binVectorA,string $binVectorB):float{return \Inilim\Tool\Method\Exp\vec_cosineSimilarity(\Inilim\Tool\Method\Exp\vec_binVecToArray($binVectorA),\Inilim\Tool\Method\Exp\vec_binVecToArray($binVectorB));}if(!\Inilim\Tool\Exp::__definedIfNot('vec_binVecToArray')){
    function vec_binVecToArray(string $vector):array{return \array_values(\unpack('f*',$vector));}
    }if(!\Inilim\Tool\Exp::__definedIfNot('vec_cosineSimilarity')){
    function vec_cosineSimilarity(array $vectorA,array $vectorB):float{[$vectorA,$normA]=\Inilim\Tool\Method\Exp\vec_normalize($vectorA);[$vectorB,$normB]=\Inilim\Tool\Method\Exp\vec_normalize($vectorB);$sim=\Inilim\Tool\Method\Exp\vec_dotProduct($vectorA,$vectorB)/($normA*$normB);return \round((float) $sim,2);}
    }if(!\Inilim\Tool\Exp::__definedIfNot('vec_dotProduct')){
    function vec_dotProduct(array $vectorA,array $vectorB):float{$dotProduct=0.0;foreach($vectorA as $i=>$vector){$dotProduct += $vector*$vectorB[$i];}return $dotProduct;}
    }if(!\Inilim\Tool\Exp::__definedIfNot('vec_normalize')){
    function vec_normalize(array $vector):array{$sum=0.0;foreach($vector as $val){$sum += $val*$val;}$norm=\sqrt($sum);if($norm==0.0){$norm=1.0;}$inv=1.0/$norm;foreach($vector as $i=>$val){$vector[$i]*= $inv;}return[$vector,$norm];}
    }}