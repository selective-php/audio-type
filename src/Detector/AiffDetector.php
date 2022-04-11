<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioMimeType;
use Selective\AudioType\AudioType;
use SplFileObject;

/**
 * Detector.
 */
final class AiffDetector implements AudioDetectorInterface
{
    /**
     * Detect AIFF/AIFC soundfile format.
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        $ckID = (string)$file->fread(4);

        // ckID is always 'FORM' for AIFF. If this is not the case, return null and do not check further.
        if ($ckID != 'FORM') {
            return null;
        }

        // Ignore the chunk size
        $file->fread(4);

        $formType = (string)$file->fread(4);

        return $formType === 'AIFF' || $formType === 'AIFC' ? new AudioType(
            AudioFormat::AIFF,
            AudioMimeType::AUDIO_AIFF
        ) : null;
    }
}
