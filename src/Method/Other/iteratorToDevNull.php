<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 * as iterator_to_array, but, without forming an array
 */
function iteratorToDevNull(\Traversable $iterator): void
{
    // TODO может использовать iterator_count?
    foreach ($iterator as $_) {
    }
}
