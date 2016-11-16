<?php namespace Trademe\Tests\Entities;

use Trademe\Entities\Listing;
use Trademe\Enums\District;
use Trademe\Enums\JobType;
use Trademe\Enums\PayType;
use Trademe\Enums\PreferredApplicationMode;
use Trademe\Factories\ListingFactory;
use Trademe\Tests\Data\Listing as ListingData;
use Trademe\Tests\TrademeTestCase;

class ListingTest extends TrademeTestCase
{
    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Category must be an unsigned integer
     */
    public function testInvalidCategory()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['Category'] = '5000';
        $this->createListing($data);
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Category must be an unsigned integer
     */
    public function testInvalidCategory2()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['Category'] = -10;
        $this->createListing($data);
    }

    public function testValidCategory()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $this->assertEquals(5073, $listing->getCategory());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Title must be a string
     */
    public function testInvalidTitle()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['Title'] = [];
        $this->createListing($data);
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Title must be no more than 50 characters long
     */
    public function testInvalidTitle2()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['Title'] = 'This title is longer than 50 characters. This title is longer than...';
        $this->createListing($data);
    }

    public function testValidTitle()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $this->assertEquals('Job Title', $listing->getTitle());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Short description must be a string
     */
    public function testInvalidShortDescription()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['ShortDescription'] = [];
        $this->createListing($data);
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Short description must be no more than 150 characters long
     */
    public function testInvalidShortDescription2()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['ShortDescription'] = str_repeat('This short description is longer than 150 characters. ', 3);
        $this->createListing($data);
    }

    public function testValidShortDescription()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $this->assertEquals(
            'Job listing short description',
            $listing->getShortDescription()
        );
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Description must be a string
     */
    public function testInvalidDescription()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['Description'] = null;
        $this->createListing($data);
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Description must be no more than 2048 characters long
     */
    public function testInvalidDescription2()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['Description'] = str_repeat('Test description', 129);
        $this->createListing($data);
    }

    public function testValidDescription()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $this->assertEquals(
            'Description of listing',
            $listing->getDescription()
        );
    }

    public function testValidJobDistrict()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $district = $listing->getJobDistrict();
        $this->assertInternalType('Trademe/Enums/District', $district);
        /*$this->assertEquals(
            'Description of listing',

        );*/
    }

    private function createListing($data)
    {
        return new Listing(
            null,
            $data['Category'],
            $data['Title'],
            $data['ShortDescription'],
            $data['Description'],
            District::get($data['JobDistrict']),
            JobType::get($data['JobType']),
            PayType::get($data['PayType']),
            PreferredApplicationMode::get($data['PreferredApplicationMode']),
            $data['ContactName']
        );
    }
}
