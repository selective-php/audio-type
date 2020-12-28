<?php

namespace Selective\AudioType\Test;

use PHPUnit\Framework\TestCase;
use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioMimeType;
use Selective\AudioType\AudioType;
use Selective\AudioType\AudioTypeDetector;
use Selective\AudioType\Exception\AudioTypeDetectorException;
use Selective\AudioType\Provider\DefaultAudioProvider;
use SplFileObject;
use SplTempFileObject;

/**
 * Test.
 */
class AudioTypeDetectorTest extends TestCase
{
    /**
     * Create instance.
     *
     * @return AudioTypeDetector The detector
     */
    private function createDetector(): AudioTypeDetector
    {
        $detector = new AudioTypeDetector();

        $detector->addProvider(new DefaultAudioProvider());

        return $detector;
    }

    /**
     * Test.
     *
     * @dataProvider providerGetAudioTypeFromFile
     *
     * @param string $file The file
     * @param string $format The expected format
     * @param string $mime The expected mime type
     *
     * @return void
     */
    public function testGetAudioTypeFromFile(string $file, string $format, string $mime): void
    {
        $this->assertFileExists($file);

        $detector = $this->createDetector();
        $file = new SplFileObject($file);
        $actual = $detector->getAudioTypeFromFile($file);

        $this->assertSame($format, $actual->getFormat());
        $this->assertSame($mime, $actual->getMimeType());
        $this->assertTrue($actual->equals(new AudioType($format, $mime)));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetAudioTypeFromFile(): array
    {
        return [
            'WAV' => [__DIR__ . '/files/test.wav', AudioFormat::WAV, AudioMimeType::AUDIO_WAV],
            'MP3' => [__DIR__ . '/files/test.mp3', AudioFormat::MP3, AudioMimeType::AUDIO_MP3],
            'FLAC' => [__DIR__ . '/files/test.flac', AudioFormat::FLAC, AudioMimeType::AUDIO_FLAC],
            'OGG' => [__DIR__ . '/files/test.oga', AudioFormat::OGA, AudioMimeType::AUDIO_OGG],
            'MIDI' => [__DIR__ . '/files/test.midi', AudioFormat::MIDI, AudioMimeType::AUDIO_MIDI],
            'AIFF' => [__DIR__ . '/files/test.aif', AudioFormat::AIFF, AudioMimeType::AUDIO_AIFF],
            'MKA' => [__DIR__ . '/files/test.mka', AudioFormat::MKA, AudioMimeType::AUDIO_MKA],
            'WEBM' => [__DIR__ . '/files/test.webm', AudioFormat::WEBM, AudioMimeType::AUDIO_WEBM],
            'RA' => [__DIR__ . '/files/test.ra', AudioFormat::RA, AudioMimeType::AUDIO_RA],
            'CAF' => [__DIR__ . '/files/test.caf', AudioFormat::CAF, AudioMimeType::AUDIO_CAF],
            'AAC' => [__DIR__ . '/files/test.aac', AudioFormat::AAC, AudioMimeType::AUDIO_AAC],
            'WMA' => [__DIR__ . '/files/test.wma', AudioFormat::WMA, AudioMimeType::AUDIO_WMA],
            'AU' => [__DIR__ . '/files/test.au', AudioFormat::AU, AudioMimeType::AUDIO_AU],
            'RMI' => [__DIR__ . '/files/test.rmi', AudioFormat::RMI, AudioMimeType::AUDIO_RMI],
        ];
    }

    /**
     * Test.
     *
     * @return void
     */
    public function testGetAudioTypeWithUnknownFormat(): void
    {
        $this->expectException(AudioTypeDetectorException::class);
        $this->expectExceptionMessage('Audio type could not be detected');

        $imageTypeDetector = new AudioTypeDetector();

        $image = new SplTempFileObject();
        $image->fwrite('temp');

        $imageTypeDetector->getAudioTypeFromFile($image);
    }
}
