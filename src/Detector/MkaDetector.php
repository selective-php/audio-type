<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioMimeType;
use Selective\AudioType\AudioType;
use SplFileObject;

/**
 * Detector.
 */
final class MkaDetector implements AudioDetectorInterface
{
    /**
     * Detect MKA (audio-only Matroska) container.
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        $bytes = bin2hex((string)$file->fread(4));
        $containedMatroska = strpos((string)$file->fread(46), 'matroska') !== false;

        return $bytes === '1a45dfa3' && $containedMatroska ? new AudioType(
            AudioFormat::MKA,
            AudioMimeType::AUDIO_MKA
        ) : null;
    }
}
