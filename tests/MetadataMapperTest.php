<?php

namespace Tests\PHPExif\Common;

use Mockery as m;
use PHPExif\Common\Data\Exif;
use PHPExif\Common\Data\Iptc;
use PHPExif\Common\Data\Metadata;
use PHPExif\Common\MetadataMapper;
use PHPExif\Common\Mapper\FieldMapper;

/**
 * Class: MetadataMapperTest
 *
 * @see \PHPUnit_Framework_TestCase
 * @coversDefaultClass \PHPExif\Common\MetadataMapper
 * @covers ::<!public>
 */
class MetadataMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::map
     * @group mapper
     *
     * @return void
     */
    public function testMapForwardsCall()
    {
        $input = [];
        $output = new Metadata(new Exif, new Iptc);

        $mock = m::mock(MetadataMapper::class . '[mapArray]')->makePartial();
        $mock->shouldReceive('mapArray')
            ->once()
            ->with(
                $input,
                m::type(Metadata::class)
            )
            ->andReturnNull();

        $mock->map($input, $output);
    }

    /**
     * @covers ::map
     * @group mapper
     *
     * @return void
     */
    public function testMapSetsRawData()
    {
        $input = [ 'raw' => 'data' ];
        $output = new Metadata(new Exif, new Iptc);

        $mock = m::mock(MetadataMapper::class . '[mapArray]')->makePartial();
        $mock->shouldReceive('mapArray')
            ->once()
            ->with(
                $input,
                m::type(Metadata::class)
            )
            ->andReturnNull();

        $this->assertCount(
            0,
            $output->getRawData()
        );

        $mock->map($input, $output);

        $this->assertEquals(
            $input,
            $output->getRawData()
        );
    }

    /**
     * @covers ::mapArray
     * @group mapper
     *
     * @return void
     */
    public function testMapArrayForwardsCall()
    {
        $input = [];
        $output = new Metadata(
            new Exif,
            new Iptc
        );

        $mapper = new MetadataMapper;

        foreach (array(Exif::class, Iptc::class) as $field) {
            $fieldMapper = m::mock(FieldMapper::class . '[getSupportedFields,mapField]');
            $fieldMapper->shouldReceive('getSupportedFields')
                ->once()
                ->andReturn(array($field));
            $fieldMapper->shouldReceive('mapField')
                ->once()
                ->with(
                    $field,
                    $input,
                    m::type(Metadata::class)
                )
                ->andReturnNull();

            $mapper->registerFieldMapper($fieldMapper);
        }

        $mapper->mapArray($input, $output);
    }
}
