<?php namespace Trademe\Tests\Entities;

use Trademe\Entities\Listing;
use Trademe\Enums\ContractDuration;
use Trademe\Enums\District;
use Trademe\Enums\JobType;
use Trademe\Enums\PayType;
use Trademe\Enums\PreferredApplicationMode;
use Trademe\Factories\ListingFactory;
use Trademe\Tests\Data\Listing as ListingData;
use Trademe\Tests\TrademeTestCase;
use Trademe\ValueObjects\HourlyRateRange;
use Trademe\ValueObjects\Phone;
use Trademe\ValueObjects\SalaryRange;

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
     * @expectedExceptionMessage Category must be an integer and be greater than 011
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
        $data['ShortDescription'] = str_repeat('A', 151);
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
        $data['Description'] = str_repeat('B', 2049);
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

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Email address format is invalid
     */
    public function testInvalidEmailAddress()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setEmailAddress('test email address');
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Email address must be no more than 50 characters long
     */
    public function testInvalidEmailAddress2()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setEmailAddress('testemailaddresswhichistoolong@someverylongdomainname.com');
    }

    public function testValidEmailAddress()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);

        $listing->setEmailAddress($data['EmailAddress']);
        $this->assertEquals($data['EmailAddress'], $listing->getEmailAddress());

        $listing->setEmailAddress(null);
        $this->assertNull($listing->getEmailAddress());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Application URL format is invalid
     */
    public function testInvalidApplicationUrl()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setApplicationUrl('invalid url');
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Application URL must be no more than 250 characters long
     */
    public function testInvalidApplicationUrl2()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setApplicationUrl('http://www.example.com/' . str_repeat('1/', 230));
    }

    public function testValidApplicationUrl()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);

        $listing->setApplicationUrl($data['ApplicationUrl']);
        $this->assertEquals($data['ApplicationUrl'], $listing->getApplicationUrl());

        $listing->setApplicationUrl(null);
        $this->assertNull($listing->getApplicationUrl());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Company must be a string
     */
    public function testInvalidCompany()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setCompany([3]);
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Company must be no more than 50 characters long
     */
    public function testInvalidCompany2()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setCompany('This company name is longer than 50 characters. This company name is longer...');
    }

    public function testValidCompany()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);

        $listing->setCompany($data['Company']);
        $this->assertEquals($data['Company'], $listing->getCompany());

        $listing->setCompany(null);
        $this->assertNull($listing->getCompany());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Pay and benefits must be a string
     */
    public function testInvalidPayAndBenefits()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setPayAndBenefits(true);
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Pay and benefits must be no more than 50 characters long
     */
    public function testInvalidPayAndBenefits2()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setPayAndBenefits('This pay and benefits is longer than 50 characters. This company name is...');
    }

    public function testValidPayAndBenefits()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);

        $listing->setPayAndBenefits($data['PayAndBenefits']);
        $this->assertEquals($data['PayAndBenefits'], $listing->getPayAndBenefits());

        $listing->setPayAndBenefits(null);
        $this->assertNull($listing->getPayAndBenefits());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Application instructions must be a string
     */
    public function testInvalidApplicationInstructions()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setApplicationInstructions(true);
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Application instructions must be no more than 500 characters long
     */
    public function testInvalidApplicationInstructions2()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setApplicationInstructions(str_repeat('A', 501));
    }

    public function testValidApplicationInstructions()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);

        $listing->setApplicationInstructions($data['ApplicationInstructions']);
        $this->assertEquals($data['ApplicationInstructions'], $listing->getApplicationInstructions());

        $listing->setApplicationInstructions(null);
        $this->assertNull($listing->getApplicationInstructions());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage External reference id must be a string
     */
    public function testInvalidExternalReferenceId()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setExternalReferenceId(4324);
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage External reference id must be no more than 50 characters long
     */
    public function testInvalidExternalReferenceId2()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setExternalReferenceId(str_repeat('A', 51));
    }

    public function testValidExternalReferenceId()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);

        $listing->setExternalReferenceId($data['ExternalReferenceId']);
        $this->assertEquals($data['ExternalReferenceId'], $listing->getExternalReferenceId());

        $listing->setExternalReferenceId(null);
        $this->assertNull($listing->getExternalReferenceId());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage YouTube video key format is invalid
     */
    public function testInvalidYouTubeVideoKey()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setYouTubeVideoKey('dhi3rhjkbfej');
    }

    public function testValidYouTubeVideoKey()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);

        $listing->setYouTubeVideoKey($data['YouTubeVideoKey']);
        $this->assertEquals($data['YouTubeVideoKey'], $listing->getYouTubeVideoKey());

        $listing->setYouTubeVideoKey(null);
        $this->assertNull($listing->getYouTubeVideoKey());
    }

    public function testValidContractDuration()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $listing->setContractDuration(ContractDuration::get($data['ContractDuration']));
        $contractDuration = $listing->getContractDuration();

        $this->assertInstanceOf('\Trademe\Enums\ContractDuration', $contractDuration);
        $this->assertEquals($data['ContractDuration'], $contractDuration->getValue());

        $listing->setContractDuration(null);
        $this->assertNull($listing->getContractDuration());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage General management must be a boolean value
     */
    public function testInvalidGeneralManagement()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setGeneralManagement('true');
    }

    public function testValidGeneralManagement()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);

        $listing->setGeneralManagement(true);
        $this->assertTrue($listing->getGeneralManagement());

        $listing->setGeneralManagement(null);
        $this->assertNull($listing->getGeneralManagement());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Work permit required must be a boolean value
     */
    public function testInvalidWorkPermitRequired()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->setWorkPermitRequired('false');
    }

    public function testValidWorkPermitRequired()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);

        $listing->setWorkPermitRequired(false);
        $this->assertFalse($listing->getWorkPermitRequired());

        $listing->setWorkPermitRequired(null);
        $this->assertNull($listing->getWorkPermitRequired());
    }

    public function testValidPhone1()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $phone = new Phone('61', '280114455');

        $listing->setPhone1($phone);
        $this->assertEquals($phone, $listing->getPhone1());

        $listing->setPhone1(null);
        $this->assertNull($listing->getPhone1());
    }

    public function testValidPhone2()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $phone = new Phone('61', '280114455');

        $listing->setPhone2($phone);
        $this->assertEquals($phone, $listing->getPhone2());

        $listing->setPhone2(null);
        $this->assertNull($listing->getPhone2());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Photo id must be an integer value
     */
    public function testAddInvalidPhoto()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->addPhoto('342');
    }

    public function testAddValidPhoto()
    {
        $listing = $this->createListing(ListingFactory::transformArray(ListingData::$data));
        $listing->addPhoto(342);
        $this->assertSame([342], $listing->getPhotos());

        $listing->addPhoto(244);
        $listing->addPhoto(146);
        $this->assertSame([342, 244, 146], $listing->getPhotos());

        $listing->removePhoto(244);
        $this->assertSame([342, 146], $listing->getPhotos());

        $listing->removePhoto(342);
        $listing->removePhoto(146);
        $this->assertSame([], $listing->getPhotos());

        $listing->setPhotos([3, 7, 5]);
        $this->assertSame([3, 7, 5], $listing->getPhotos());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Branding banner must be an integer and be greater than 0
     */
    public function testInvalidBrandingBanner()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $listing->setBrandingBanner('a');
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Branding banner must be an integer and be greater than 0
     */
    public function testInvalidBrandingBanner2()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $listing->setBrandingBanner(0);
    }

    public function testValidBrandingBanner()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $listing->setBrandingBanner($data['BrandingBanner']);
        $this->assertEquals($data['BrandingBanner'], $listing->getBrandingBanner());

        $listing->setBrandingBanner(null);
        $this->assertEquals(null, $listing->getBrandingBanner());
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Branding logo must be an integer and be greater than 0
     */
    public function testInvalidBrandingLogo()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $listing->setBrandingLogo('a');
    }

    /**
     * @expectedException \Trademe\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage Branding logo must be an integer and be greater than 0
     */
    public function testInvalidBrandingLogo2()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $listing->setBrandingLogo(0);
    }

    public function testValidBrandingLogo()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $listing->setBrandingLogo($data['BrandingLogo']);
        $this->assertEquals($data['BrandingLogo'], $listing->getBrandingLogo());

        $listing->setBrandingLogo(null);
        $this->assertEquals(null, $listing->getBrandingLogo());
    }

    /**
     * @expectedException \Trademe\Exceptions\EntityValidationException
     * @expectedExceptionMessage Email address cannot be empty with current application mode
     */
    public function testPrevalidateMissingEmail()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $listing->setPreferredApplicationMode(PreferredApplicationMode::EMAIL());
        $listing->prevalidate();
    }

    /**
     * @expectedException \Trademe\Exceptions\EntityValidationException
     * @expectedExceptionMessage Phone 1 cannot be empty with current application mode
     */
    public function testPrevalidateMissingPhone()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $listing->setPreferredApplicationMode(PreferredApplicationMode::PHONE());
        $listing->prevalidate();
    }

    /**
     * @expectedException \Trademe\Exceptions\EntityValidationException
     * @expectedExceptionMessage Application url cannot be empty with current application mode
     */
    public function testPrevalidateMissingWebsite()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $listing->setPreferredApplicationMode(PreferredApplicationMode::WEBSITE());
        $listing->prevalidate();
    }

    /**
     * @expectedException \Trademe\Exceptions\EntityValidationException
     * @expectedExceptionMessage Salary range cannot be empty when pay type is set to salary
     */
    public function testPrevalidateMissingSalaryRange()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $listing->setPreferredApplicationMode(PreferredApplicationMode::EMAIL());
        $listing->setEmailAddress('test@test.com');
        $listing->setPayType(PayType::SALARY());
        $listing->prevalidate();
    }

    /**
     * @expectedException \Trademe\Exceptions\EntityValidationException
     * @expectedExceptionMessage Hourly rate range cannot be empty when pay type is set to hourly
     */
    public function testPrevalidateMissingHourlyRateRange()
    {
        $data = ListingFactory::transformArray(ListingData::$data);
        $listing = $this->createListing($data);
        $listing->setPreferredApplicationMode(PreferredApplicationMode::EMAIL());
        $listing->setEmailAddress('test@test.com');
        $listing->setPayType(PayType::HOURLY());
        $listing->prevalidate();
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
