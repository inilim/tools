<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * Cosine similarity on binary vectors.
 */
function vec_cosineSimilarityBin(string $binVectorA, string $binVectorB): float
{
    return \Inilim\Tool\Method\Exp\vec_cosineSimilarity(
        \Inilim\Tool\Method\Exp\vec_binVecToArray($binVectorA),
        \Inilim\Tool\Method\Exp\vec_binVecToArray($binVectorB),
    );
}
