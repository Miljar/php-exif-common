<?php

namespace Tests\PHPExif\Common\Collection;

use Mockery as m;
use PHPExif\Common\Collection\AbstractCollection;
use PHPExif\Common\Exception\Collection\ElementAlreadyExistsException;

/**
 * Class: AbstractCollectionTest
 *
 * @see \PHPUnit_Framework_TestCase
 * @abstract
 * @coversDefaultClass \PHPExif\Common\Collection\AbstractCollection
 * @covers ::<!public>
 */
class AbstractCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @group collection
     *
     * @return void
     */
    public function testConstructorAddsElementsFromParameter()
    {
        $input = array(
            'foo' => 'bar',
            'baz' => 'quux',
        );
        $ctr = array(
            'key' => 0,
            'value' => 0,
        );

        $checker = function ($type) use ($input, &$ctr) {
            return function ($arg) use ($input, $type, &$ctr) {
                $result = false;

                $data = null;
                if ($type === 'key') {
                    $data = array_keys($input);
                } else {
                    $data = array_values($input);
                }

                if ($arg === $data[$ctr[$type]]) {
                    $result = true;
                }

                $ctr[$type]++;

                return $result;
            };
        };

        $mock = m::mock(
            AbstractCollection::class
        )->shouldDeferMissing();
        $mock->shouldReceive('add')
            ->with(
                m::on(
                    $checker('key')
                ),
                m::on(
                    $checker('value')
                )
            )
            ->andReturnNull();

        $mock->__construct($input);

        $this->assertEquals(
            count($input),
            $ctr['key']
        );
        $this->assertEquals(
            count($input),
            $ctr['value']
        );
    }

    /**
     * @covers ::add
     * @group collection
     *
     * @return void
     */
    public function testAddThrowsExceptionForExistingKey()
    {
        $this->expectException(ElementAlreadyExistsException::class);

        $mock = m::mock(
            AbstractCollection::class . '[exists]',
            array()
        )->shouldDeferMissing();
        $mock->shouldReceive('exists')
            ->with('foo')
            ->andReturn(true);

        $mock->add('foo', 'bar');
    }

    /**
     * @covers ::add
     * @group collection
     *
     * @return void
     */
    public function testAddReturnsCurrentInstance()
    {
        $mock = m::mock(
            AbstractCollection::class . '[exists]',
            array()
        )->shouldDeferMissing();
        $mock->shouldReceive('exists')
            ->with('foo')
            ->andReturn(false);

        $result = $mock->add('foo', 'bar');

        $this->assertSame(
            $mock,
            $result
        );
    }

    /**
     * @covers ::add
     * @group collection
     *
     * @return void
     */
    public function testAddInsertsInCollection()
    {
        $mock = m::mock(
            AbstractCollection::class . '[exists]',
            array()
        )->shouldDeferMissing();
        $mock->shouldReceive('exists')
            ->with('foo')
            ->andReturn(false);

        $this->assertEquals(
            0,
            $mock->count()
        );

        $mock->add('foo', 'bar');

        $this->assertEquals(
            1,
            $mock->count()
        );
    }
}
