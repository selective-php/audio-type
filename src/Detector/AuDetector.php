<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioMimeType;
use Selective\AudioType\AudioType;
use SplFileObject;

/**
 * Detector.
 */
final class AuDetector implements AudioDetectorInterface
{
    /**
     * Detect AU audio file.
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        $bytes = (string)$file->fread(4);

        return $bytes === '.snd' ? new AudioType(
            AudioFormat::AU,
            AudioMimeType::AUDIO_AU
        ) : null;
    }
}
