<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioMimeType;
use Selective\AudioType\AudioType;
use SplFileObject;

final class RealAudioDetector implements AudioDetectorInterface
{
    /**
     * Detects RealAudio
     *
     * @param SplFileObject $file The file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        return (string)$file->fread(5) === '.raý.' ? new AudioType(
            AudioFormat::RA,
            AudioMimeType::AUDIO_RA
        ) : null;
    }
}