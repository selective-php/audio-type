<?php

namespace Selective\AudioType\Provider;

use Selective\AudioType\Detector\AiffDetector;
use Selective\AudioType\Detector\MidiDetector;
use Selective\AudioType\Detector\Mp3Detector;
use Selective\AudioType\Detector\WavDetector;
use Selective\AudioType\Detector\FlacDetector;
use Selective\AudioType\Detector\OgaDetector;
use Selective\AudioType\Detector\MkaDetector;
use Selective\AudioType\Detector\WebmDetector;
use Selective\AudioType\Detector\RealAudioDetector;
use Selective\AudioType\Detector\CafDetector;
use Selective\AudioType\Detector\AacDetector;
use Selective\AudioType\Detector\WmaDetector;
use Selective\AudioType\Detector\AuDetector;
use Selective\AudioType\Detector\RmiDetector;

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
            new FlacDetector(),
            new OgaDetector(),
            new MidiDetector(),
            new AiffDetector(),
            new MkaDetector(),
            new WebmDetector(),
            new RealAudioDetector(),
            new CafDetector(),
            new AacDetector(),
            new WmaDetector(),
            new AuDetector(),
            new RmiDetector(),
        ];
    }
}
