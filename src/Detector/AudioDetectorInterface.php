<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioType;
use SplFileObject;

/**
 * Detector.
 */
interface AudioDetectorInterface
{
    /**
     * Detect.
     *
     * @param SplFileObject $file The file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType;
}
