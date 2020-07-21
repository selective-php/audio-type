<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioType;
use Selective\AudioType\AudioMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class AacDetector implements AudioDetectorInterface
{
    /**
     * Detect AAC audio file format.
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        // Skip 8 bytes
        $file->fread(8);

        // ISO Base Media File Format, the brand "M4A " is used.
        $brand = $file->fread(4);

        return $brand === 'M4A ' ? new AudioType(
            AudioFormat::AAC,
            AudioMimeType::AUDIO_AAC
        ) : null;
    }
}
