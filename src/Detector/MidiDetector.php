<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioMimeType;
use Selective\AudioType\AudioType;
use SplFileObject;

/**
 * Detector.
 */
final class MidiDetector implements AudioDetectorInterface
{
    /**
     * Detects MIDI format.
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        $chunkType = (string)$file->fread(4);

        return $chunkType === 'MThd' ? new AudioType(
            AudioFormat::MIDI,
            AudioMimeType::AUDIO_MIDI
        ) : null;
    }
}
