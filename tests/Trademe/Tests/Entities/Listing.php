<?php namespace Trademe\Tests\Entities;

use Trademe\Entities\Listing;
use Trademe\Entities\SalaryRange;
use Trademe\Entities\HourlyRateRange;
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
     * @expectedExceptionMessage Category must be an integer and be greater than 0
     */
    public function testInvalidCategory()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['Category'] = '5000';
        $this->createListing($data);
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Category must be an integer and be greater than 0
     */
    public function testInvalidCategory2()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['Category'] = 0;
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

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Title cannot be empty
     */
    public function testInvalidTitle3()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['Title'] = '';
        $this->createListing($data);
    }

    public function testValidTitle()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $this->assertEquals($data['Title'], $listing->getTitle());
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

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Short description cannot be empty
     */
    public function testInvalidShortDescription3()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['ShortDescription'] = '';
        $this->createListing($data);
    }

    public function testValidShortDescription()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $this->assertEquals($data['ShortDescription'], $listing->getShortDescription());
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

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Description cannot be empty
     */
    public function testInvalidDescription3()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['Description'] = '';
        $this->createListing($data);
    }

    public function testValidDescription()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $this->assertEquals($data['Description'], $listing->getDescription());
    }

    public function testValidJobDistrict()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $district = $listing->getJobDistrict();
        $this->assertInstanceOf('\Trademe\Enums\District', $district);
        $this->assertEquals($data['JobDistrict'], $district->getValue());
    }

    public function testValidJobType()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $jobType = $listing->getJobType();
        $this->assertInstanceOf('\Trademe\Enums\JobType', $jobType);
        $this->assertEquals($data['JobType'], $jobType->getValue());
    }

    public function testValidPreferredApplicationMode()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $preferredApplicationMode = $listing->getPreferredApplicationMode();
        $this->assertInstanceOf('\Trademe\Enums\PreferredApplicationMode', $preferredApplicationMode);
        $this->assertEquals($data['PreferredApplicationMode'], $preferredApplicationMode->getValue());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Contact name must be a string
     */
    public function testInvalidContactName()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['ContactName'] = 324;
        $this->createListing($data);
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Contact name must be no more than 50 characters long
     */
    public function testInvalidContactName2()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['ContactName'] = 'This contact name is longer than 50 characters. This contact name is longer than...';
        $this->createListing($data);
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Contact name cannot be empty
     */
    public function testInvalidContactName3()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $data['ContactName'] = '';
        $this->createListing($data);
    }

    public function testValidContactName()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $this->assertEquals($data['ContactName'], $listing->getContactName());
    }

    public function testValidSalaryRange()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $salaryRange = new SalaryRange($data['ApproximatePay'], $data['ApproximatePayRangeHigh']);

        $listing->setSalaryRange($salaryRange);
        $this->assertEquals($salaryRange, $listing->getSalaryRange());

        $listing->setSalaryRange(null);
        $this->assertNull($listing->getSalaryRange());
    }

    public function testValidHourlyRateRange()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $hourlyRateRange = new HourlyRateRange($data['HourlyRateRangeLower'], $data['HourlyRateRangeUpper']);

        $listing->setHourlyRateRange($hourlyRateRange);
        $this->assertEquals($hourlyRateRange, $listing->getHourlyRateRange());

        $listing->setHourlyRateRange(null);
        $this->assertNull($listing->getHourlyRateRange());
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
