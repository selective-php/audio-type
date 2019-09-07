<?php

namespace Selective\AudioType\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Selective\AudioType\AudioFormat;
use Selective\AudioType\AudioMimeType;
use Selective\AudioType\AudioType;

/**
 * Test.
 */
class AudioTypeTest extends TestCase
{
    /**
     * Test.
     *
     * @return void
     */
    public function testCreateInstance(): void
    {
        $imageType = new AudioType(AudioFormat::WAV, AudioMimeType::AUDIO_WAV);

        $this->assertSame(AudioFormat::WAV, $imageType->getFormat());
        $this->assertSame(AudioMimeType::AUDIO_WAV, $imageType->getMimeType());
    }

    /**
     * Test.
     *
     * @return void
     */
    public function testCreateInstanceWithError(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AudioType('', '');
    }

    /**
     * Test.
     *
     * @return void
     */
    public function testCreateInstanceWithError2(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new AudioType(AudioFormat::WAV, '');
    }
}
