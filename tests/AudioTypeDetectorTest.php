<?php

namespace Selective\AudioType\Test;

use PHPUnit\Framework\TestCase;
use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioType;
use Selective\AudioType\AudioTypeDetector;
use Selective\AudioType\Exception\AudioTypeDetectorException;
use Selective\AudioType\AudioMimeType;
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
