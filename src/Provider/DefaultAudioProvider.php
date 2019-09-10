<?php

namespace Selective\AudioType\Provider;

use Selective\AudioType\Detector\Mp3Detector;
use Selective\AudioType\Detector\WavDetector;

/**
 * All supported audio formats.
 */
class DefaultAudioProvider implements ProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDetectors(): array
    {
        return [
            new Mp3Detector(),
            new WavDetector(),
        ];
    }
}
