<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioType;
use Selective\AudioType\AudioMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class Mp3Detector implements AudioDetectorInterface
{
    /**
     * Detect MP3 (MPEG-1 Audio Layer 3 (MP3) audio file) format.
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        // MP3 file with an ID3v2 container
        $hasId3v2Container = (string)$file->fread(3) === 'ID3';

        return $hasId3v2Container ? new AudioType(
            AudioFormat::MP3,
            AudioMimeType::AUDIO_MP3
        ) : null;
    }
}
