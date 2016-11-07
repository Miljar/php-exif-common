<?php

namespace Tests\PHPExif\Common\Data;

use Mockery as m;
use PHPExif\Common\Data\Exif;
use PHPExif\Common\Data\ValueObject\Exif\Aperture;
use PHPExif\Common\Data\ValueObject\Exif\Filename;
use PHPExif\Common\Data\ValueObject\Exif\Filesize;
use PHPExif\Common\Data\ValueObject\Exif\Make;
use PHPExif\Common\Data\ValueObject\Exif\MimeType;

/**
 * Class: ExifTest
 *
 * @see \PHPUnit_Framework_TestCase
 * @abstract
 * @coversDefaultClass \PHPExif\Common\Data\Exif
 * @covers ::<!public>
 */
class ExifTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::withAperture
     * @group data
     * @group exif
     *
     * @return void
     */
    public function testWithApertureReturnsNewExifInstance()
    {
        $old = new Exif();
        $new = $old->withAperture(new Aperture(5.6));

        $this->assertInstanceOf(
            Exif::class,
            $new
        );

        $this->assertNotSame($old, $new);
    }

    /**
     * @covers ::getAperture
     * @group data
     * @group exif
     *
     * @return void
     */
    public function testGetApertureReturnsCorrectData()
    {
        $aperture = new Aperture(5.6);
        $old = new Exif();
        $new = $old->withAperture($aperture);

        $this->assertSame(
            $aperture,
            $new->getAperture()
        );
    }

    /**
     * @covers ::withMimeType
     * @group data
     * @group exif
     *
     * @return void
     */
    public function testWithMimeTypeReturnsNewExifInstance()
    {
        $old = new Exif();
        $new = $old->withMimeType(new MimeType('image/jpeg'));

        $this->assertInstanceOf(
            Exif::class,
            $new
        );

        $this->assertNotSame($old, $new);
    }

    /**
     * @covers ::getMimeType
     * @group data
     * @group exif
     *
     * @return void
     */
    public function testGetMimeTypeReturnsCorrectData()
    {
        $mimeType = new MimeType('image/jpeg');
        $old = new Exif();
        $new = $old->withMimeType($mimeType);

        $this->assertSame(
            $mimeType,
            $new->getMimeType()
        );
    }

    /**
     * @covers ::withFilename
     * @group data
     * @group exif
     *
     * @return void
     */
    public function testWithFilenameReturnsNewExifInstance()
    {
        $old = new Exif();
        $new = $old->withFilename(new Filename('IMG_01234.JPG'));

        $this->assertInstanceOf(
            Exif::class,
            $new
        );

        $this->assertNotSame($old, $new);
    }

    /**
     * @covers ::getFilename
     * @group data
     * @group exif
     *
     * @return void
     */
    public function testGetFilenameReturnsCorrectData()
    {
        $filename = new Filename('IMG_01234.JPG');
        $old = new Exif();
        $new = $old->withFilename($filename);

        $this->assertSame(
            $filename,
            $new->getFilename()
        );
    }

    /**
     * @covers ::withFilesize
     * @group data
     * @group exif
     *
     * @return void
     */
    public function testWithFilesizeReturnsNewExifInstance()
    {
        $old = new Exif();
        $new = $old->withFilesize(new Filesize(123456));

        $this->assertInstanceOf(
            Exif::class,
            $new
        );

        $this->assertNotSame($old, $new);
    }

    /**
     * @covers ::getFilesize
     * @group data
     * @group exif
     *
     * @return void
     */
    public function testGetFilesizeReturnsCorrectData()
    {
        $filesize = new Filesize(123456);
        $old = new Exif();
        $new = $old->withFilesize($filesize);

        $this->assertSame(
            $filesize,
            $new->getFilesize()
        );
    }

    /**
     * @covers ::withMake
     * @group data
     * @group exif
     *
     * @return void
     */
    public function testWithMakeReturnsNewExifInstance()
    {
        $old = new Exif();
        $new = $old->withMake(new Make('Nikon'));

        $this->assertInstanceOf(
            Exif::class,
            $new
        );

        $this->assertNotSame($old, $new);
    }

    /**
     * @covers ::getMake
     * @group data
     * @group exif
     *
     * @return void
     */
    public function testGetMakeReturnsCorrectData()
    {
        $make = new Make('Nikon');
        $old = new Exif();
        $new = $old->withMake($make);

        $this->assertSame(
            $make,
            $new->getMake()
        );
    }
}
