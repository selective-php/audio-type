<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioMimeType;
use Selective\AudioType\AudioType;
use SplFileObject;

/**
 * Detector.
 */
final class WmaDetector implements AudioDetectorInterface
{
    /**
     * Detect WMA audio format.
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        $asfMagicNumber = bin2hex((string)$file->fread(4));

        return (string)$asfMagicNumber === '3026b275' ? new AudioType(
            AudioFormat::WMA,
            AudioMimeType::AUDIO_WMA
        ) : null;
    }
}
