<?php namespace Trademe\Tests\Entities;

use Trademe\Entities\Listing;
use Trademe\Enums\JobType;
use Trademe\Enums\PayType;
use Trademe\Enums\PreferredApplicationMode;
use Trademe\Tests\TrademeTestCase;

class ListingTest extends TrademeTestCase
{
    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     */
    public function testInvalidCategory()
    {
        new Listing(
            'test',
            'title',
            'short desc',
            'desc',
            30,
            321,
            JobType::get('FT'),
            PayType::get('Salary'),
            PreferredApplicationMode::get('E'),
            'John Citizen'
        );
    }

    /*public function testValidate()
    {
        $field = $this->createField();
        $this->assertEquals(true, $field->validate(true));
        $this->assertEquals(true, $field->validate(false));
        $this->assertEquals(true, $field->validate(null));
    }

    public function testParseDataSourceValue()
    {
        $field = $this->createField();
        $object = $field->parseDataSourceValue('');
        $this->assertSame($object, $field);
        $this->assertSame(false, $field->value());

        $field->parseDataSourceValue(0);
        $this->assertSame(false, $field->value());

        $field->parseDataSourceValue('1');
        $this->assertSame(true, $field->value());

        $field->parseDataSourceValue('1dddsd');
        $this->assertSame(true, $field->value());

        $field->parseDataSourceValue(null);
        $this->assertSame(null, $field->value());
    }

    public function testParseStringValue()
    {
        $field = $this->createField();
        $object = $field->parseStringValue('');
        $this->assertSame($object, $field);
        $this->assertSame(false, $field->value());

        $field->parseStringValue(0);
        $this->assertSame(false, $field->value());

        $field->parseStringValue(1);
        $this->assertSame(true, $field->value());

        $field->parseStringValue(true);
        $this->assertSame(true, $field->value());

        $field->parseStringValue(false);
        $this->assertSame(false, $field->value());

        $field->parseStringValue('0');
        $this->assertSame(false, $field->value());

        $field->parseStringValue('1');
        $this->assertSame(true, $field->value());

        $field->parseStringValue('true');
        $this->assertSame(true, $field->value());

        $field->parseStringValue('false');
        $this->assertSame(false, $field->value());

        $field->parseStringValue(null);
        $this->assertSame(null, $field->value());
    }

    public function testGetFieldType()
    {
        $field = $this->createField();
        $this->assertEquals(Types::BOOLEAN, $field->getType());
    }*/

    public function createListing($data = [])
    {
        return new Listing('', '', '', '', JobType::getByName('FT'));
    }
}
