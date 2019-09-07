<?php

namespace Selective\AudioType;

use InvalidArgumentException;

/**
 * Audio type value object.
 */
final class AudioType
{
    /**
     * @var string The audio format
     */
    private $format;

    /**
     * @var string The mime type
     */
    private $mime;

    /**
     * The constructor.
     *
     * @param string $format The image format
     * @param string $mime The mime type
     */
    public function __construct(string $format, string $mime)
    {
        if (empty($format)) {
            throw new InvalidArgumentException(sprintf('Invalid type: %s', $format));
        }

        if (empty($mime)) {
            throw new InvalidArgumentException(sprintf('Invalid mime type: %s', $format));
        }

        $this->format = $format;
        $this->mime = $mime;
    }

    /**
     * Get audio format.
     *
     * @return string The audio format
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Get mime type.
     *
     * @return string The mime type
     */
    public function getMimeType(): string
    {
        return $this->mime;
    }

    /**
     * Compare with other audio type.
     *
     * @param AudioType $other The other type
     *
     * @return bool Status
     */
    public function equals(AudioType $other): bool
    {
        return $this->format === $other->format &&
            $this->mime === $other->mime;
    }
}
