<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioMimeType;
use Selective\AudioType\AudioType;
use SplFileObject;

/**
 * Detector.
 */
final class CafDetector implements AudioDetectorInterface
{
    /**
     * Detects CAF (Apple Core Audio File)
     *
     * @param SplFileObject $file The file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        return (string)$file->fread(4) === 'caff' ? new AudioType(
            AudioFormat::CAF,
            AudioMimeType::AUDIO_CAF
        ) : null;
    }
}
