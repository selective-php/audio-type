<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioType;
use Selective\AudioType\AudioMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class WavDetector implements AudioDetectorInterface
{
    /**
     * Detect WAVE PCM soundfile format.
     *
     * http://soundfile.sapp.org/doc/WaveFormat/
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        $chunkId = (string)$file->fread(4);

        // Ignore the chunk size
        $file->fread(4);

        $format = (string)$file->fread(4);

        return $chunkId === 'RIFF' && $format === 'WAVE' ? new AudioType(
            AudioFormat::WAV,
            AudioMimeType::AUDIO_WAV
        ) : null;
    }
}
