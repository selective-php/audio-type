<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioMimeType;
use Selective\AudioType\AudioType;
use SplFileObject;

/**
 * Detector.
 */
final class OgaDetector implements AudioDetectorInterface
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
        $bytes = (string)$file->fread(4);

        if ($bytes !== 'OggS') {
            return null;
        }

        return new AudioType(AudioFormat::OGA, AudioMimeType::AUDIO_OGG);
    }
}
