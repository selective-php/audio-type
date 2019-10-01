<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioType;
use Selective\AudioType\AudioMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class FlacDetector implements AudioDetectorInterface
{
    /**
     * Detect FLAC soundfile format.
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        // Signature bytes
        $signature = (string)$file->fread(4);

        return 'fLaC' === $signature ? new AudioType(
            AudioFormat::FLAC,
            AudioMimeType::AUDIO_FLAC
        ) : null;
    }
}
