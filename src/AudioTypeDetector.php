<?php

namespace Selective\AudioType;

use Selective\AudioType\Detector\AudioDetectorInterface;
use Selective\AudioType\Exception\AudioTypeDetectorException;
use Selective\AudioType\Provider\ProviderInterface;
use SplFileObject;

/**
 * Audio type detection.
 */
final class AudioTypeDetector
{
    /**
     * @var AudioDetectorInterface[]
     */
    private $detectors = [];

    /**
     * Add detector.
     *
     * @param AudioDetectorInterface $detector The detector
     */
    public function addDetector(AudioDetectorInterface $detector): void
    {
        $this->detectors[] = $detector;
    }

    /**
     * Add provider.
     *
     * @param ProviderInterface $provider The provider
     *
     * @return void
     */
    public function addProvider(ProviderInterface $provider): void
    {
        foreach ($provider->getDetectors() as $detector) {
            $this->addDetector($detector);
        }
    }

    /**
     * Detect audio type.
     *
     * @param SplFileObject $file The audio file
     *
     * @throws AudioTypeDetectorException
     *
     * @return AudioType The audio type
     */
    public function getAudioTypeFromFile(SplFileObject $file): AudioType
    {
        $type = $this->detectFile($file);

        if ($type === null) {
            throw new AudioTypeDetectorException('Audio type could not be detected');
        }

        return $type;
    }

    /**
     * Reads and returns the type of the audio file.
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null
     */
    private function detectFile(SplFileObject $file): ?AudioType
    {
        foreach ($this->detectors as $detector) {
            $file->rewind();

            $type = $detector->detect($file);

            if ($type !== null) {
                return $type;
            }
        }

        return null;
    }
}
