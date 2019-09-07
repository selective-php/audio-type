<?php

namespace Selective\AudioType\Provider;

use Selective\AudioType\Detector\AudioDetectorInterface;

interface ProviderInterface
{
    /**
     * Return list of detectors.
     *
     * @return AudioDetectorInterface[] The list
     */
    public function getDetectors(): array;
}
