<?php

namespace Selective\AudioType\Detector;

use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioMimeType;
use Selective\AudioType\AudioType;
use SplFileObject;

/**
 * Detector.
 */
final class WebmDetector implements AudioDetectorInterface
{
    /**
     * Detect WEBM soundfile format.
     *
     * https://en.wikipedia.org/wiki/WebM
     * http://fileformats.archiveteam.org/wiki/Webm
     *
     * To generate a webm audio file, run: ffmpeg.exe -i test.mp3 -vn test.webm
     *
     * @param SplFileObject $file The audio file
     *
     * @return AudioType|null The audio type
     */
    public function detect(SplFileObject $file): ?AudioType
    {
        $ebmlHeader = bin2hex((string)$file->fread(4));
        $containedWebM = strpos((string)$file->fread(40), 'webm') !== false;
        $header = (string)$file->fread(1024);
        $hasAudioCodec = strpos($header, 'A_VORBIS') !== false || strpos($header, 'A_OPUS') !== false;
        $hasVideoCodec = strpos($header, 'V_VP8') !== false || strpos($header, 'V_VP9') !== false;

        if ($ebmlHeader === '1a45dfa3' && $containedWebM && $hasAudioCodec && !$hasVideoCodec) {
            return new AudioType(AudioFormat::WEBM, AudioMimeType::AUDIO_WEBM);
        }

        return null;
    }
}
