<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioType;
use Selective\AudioType\AudioMimeType;
use SplFileObject;

/**
 * Detector.
 */
final class AiffDetector implements AudioDetectorInterface
{
    /**
     * Detect AIFF soundfile format.
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        $formChunkId = (string) $file->fread(4);
        $chunkLength = (string) $file->fread(4);
        $formType = (string) $file->fread(4);

        return $formChunkId === 'FORM' && $formType === 'AIFF' ? new AudioType(
            AudioFormat::AIFF,
            AudioMimeType::AUDIO_AIFF
        ) : null;
    }
}
