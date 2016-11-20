<?php namespace Trademe\Tests\Api;

use Trademe\Api\Listing as ListingApi;
use Trademe\Factories\ListingFactory;
use Trademe\Tests\Data\Listing as ListingData;

class ListingTest extends TestCase
{
    public function testRetrieve()
    {
        $listing = ListingFactory::createListingFromArray(ListingFactory::transformArray(ListingData::$data));
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('get')
            ->with('/Selling/Listings/5030919.json')
            ->will($this->returnValue(ListingData::$data));
        $this->assertEquals($listing, $api->retrieve(5030919));
    }

    public function testCreate()
    {
        $listing = ListingFactory::createListingFromArray(ListingFactory::transformArray(ListingData::$data));
        $expected = ['Success' => 1, 'Description' => 'ListingId 5041494 created.', 'ListingId' => 5041494];
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('/Selling.json')
            ->will($this->returnValue($expected));
        $this->assertEquals($expected, $api->create($listing));
    }

    public function testUpdate()
    {
        $listing = ListingFactory::createListingFromArray(ListingFactory::transformArray(ListingData::$data));
        $expected = ['Success' => 1, 'Description' => 'ListingId 5041494 updated.', 'ListingId' => 5041494];
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('/Selling/Edit.json')
            ->will($this->returnValue($expected));
        $this->assertEquals($expected, $api->update($listing));
    }

    public function testValidate()
    {
        $listing = ListingFactory::createListingFromArray(ListingFactory::transformArray(ListingData::$data));
        $expected = ['Success' => 1, 'Description' => 'Listing request is valid.'];
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('/Selling/Validate.json')
            ->will($this->returnValue($expected));
        $this->assertEquals($expected, $api->validate($listing));
    }

    public function testWithdraw()
    {
        $expected = ['Success' => 1, 'Description' => '5041494 withdrawn', 'ListingId' => 5041494];
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('/Selling/Withdraw.json')
            ->will($this->returnValue($expected));
        $this->assertEquals($expected, $api->withdraw(5041494, true));
    }

    public function testRelist()
    {
        $expected = ['Success' => 1, 'Description' => '5032388 relisted as 5041571.', 'ListingId' => 5041571];
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('/Selling/Relist.json')
            ->will($this->returnValue($expected));
        $this->assertEquals($expected, $api->relist(5041571));
    }

    public function testRelistWithEdits()
    {
        $listing = ListingFactory::createListingFromArray(ListingFactory::transformArray(ListingData::$data));
        $expected = ['Success' => 1, 'Description' => '5030919 relisted as 5041589.', 'ListingId' => 5041589];
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('/Selling/RelistWithEdits.json')
            ->will($this->returnValue($expected));
        $this->assertEquals($expected, $api->relistWithEdits($listing));
    }

    public function testDuplicate()
    {
        $expected = ['Success' => 1, 'Description' => 'Created similar item.', 'ListingId' => 5041606];
        $api = $this->getApiMock();
        $api->expects($this->once())
            ->method('post')
            ->with('/Selling/Similar.json')
            ->will($this->returnValue($expected));
        $this->assertEquals($expected, $api->duplicate(5041589));
    }

    /**
     * @return string
     */
    protected function getApiClass()
    {
        return ListingApi::class;
    }
}
