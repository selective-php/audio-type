# selective/audio-type

Audio format detection library for PHP.

[![Latest Version on Packagist](https://img.shields.io/github/release/selective-php/audio-type.svg?style=flat-square)](https://packagist.org/packages/selective/audio-type)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/selective-php/audio-type/master.svg?style=flat-square)](https://travis-ci.org/selective-php/audio-type)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/selective-php/audio-type.svg?style=flat-square)](https://scrutinizer-ci.com/g/selective-php/audio-type/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/selective-php/audio-type.svg?style=flat-square)](https://scrutinizer-ci.com/g/selective-php/audio-type/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/selective/audio-type.svg?style=flat-square)](https://packagist.org/packages/selective/audio-type/stats)


## Features

* Detection of the audio type based on its header
* No dependencies
* Very fast

### Supported formats

* **MP3** (MPEG-1 Audio Layer III)
* **WAV** (WAVE PCM soundfile format)
* **MIDI** (Musical Instrument Digital Interface)
* **FLAC** (Free Lossless Audio Codec)
* **OGA** (OGG Vorbis sound format)
* **MKA** (Audio-only Matroska container)
* **WEBM** (Audio only)
* **RealAudio** (It contains only audio)
* **AIFF** (Audio Interchange File Format)
* **CAF** (Apple Core Audio File)
* **AAC** (Advanced Audio Coding)
* **WMA** (Windows Media Audio)
* **RMI** (RIFF-MIDI Audio)

## Requirements

* PHP 7.1+

## Installation

```
composer require selective/audio-type
```

## Usage

### Detect the audio type of file

```php
use Selective\AudioType\AudioTypeDetector;
use Selective\AudioType\Provider\DefaultAudioVideoProvider;
use SplFileObject;

$file = new SplFileObject('example.mp3');

$detector = new AudioTypeDetector();

// Add video detectors
$detector->addProvider(new DefaultVideoProvider());
$audioType = $detector->getAudioTypeFromFile($file);

// Get the video format
echo $audioType->getFormat(); // mp3

// Get the mime type
echo $audioType->getMimeType(); // audio/mp3
```

### Detect the audio type of in-memory object

```php
$audio = new SplTempFileObject();

$audio->fwrite('my file content');

$detector = new AudioTypeDetector();

// Add audio detectors
$detector->addProvider(new DefaultAudioProvider());

echo $detector->getAudioTypeFromFile($file)->getFormat();
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
