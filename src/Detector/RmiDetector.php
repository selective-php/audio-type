<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioMimeType;
use Selective\AudioType\AudioType;
use SplFileObject;

/**
 * Detector.
 */
final class RmiDetector implements AudioDetectorInterface
{
    /**
     * Detect RMI, RIFF-MIDI audio format.
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        $magicNumber = (string)$file->fread(4);
        $header = (string)$file->fread(25);
        $hasIdentifiedHeader = strpos($header, 'RMIDdata') !== false || strpos($header, 'MThd') !== false;

        return $magicNumber === 'RIFF' && $hasIdentifiedHeader ? new AudioType(
            AudioFormat::RMI,
            AudioMimeType::AUDIO_RMI
        ) : null;
    }
}
