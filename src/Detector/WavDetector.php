<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioType;
use Selective\AudioType\AudioMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class WavDetector implements AudioDetectorInterface
{
    /**
     * WAV.
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        $bytes = (string)$file->fread(3);

        return $bytes === 'WAV' ? new AudioType(AudioFormat::WAV, AudioMimeType::AUDIO_WAV) : null;
    }
}
