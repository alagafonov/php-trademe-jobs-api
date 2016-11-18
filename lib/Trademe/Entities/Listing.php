<?php namespace Trademe\Entities;

use Trademe\Enums\ContractDuration;
use Trademe\Enums\District;
use Trademe\Enums\JobType;
use Trademe\Enums\PayType;
use Trademe\Enums\PreferredApplicationMode;
use Trademe\Exceptions\InvalidArgumentException;
use Trademe\ValueObjects\HourlyRateRange;
use Trademe\ValueObjects\Phone;
use Trademe\ValueObjects\SalaryRange;

/**
 * Listing entity
 */
class Listing extends Entity
{
    /**
     * @var int
     */
    protected $category;

    /**
     * @var int
     */
    protected $duration = 30;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $shortDescription;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var District
     */
    protected $jobDistrict;

    /**
     * @var JobType
     */
    protected $jobType;

    /**
     * @var PayType
     */
    protected $payType;

    /**
     * @var string
     */
    protected $contactName;

    /**
     * @var PreferredApplicationMode
     */
    protected $preferredApplicationMode;

    /**
     * @var SalaryRange
     */
    protected $salaryRange;

    /**
     * @var HourlyRateRange
     */
    protected $hourlyRateRange;

    /**
     * @var string
     */
    protected $emailAddress;

    /**
     * @var string
     */
    protected $applicationUrl;

    /**
     * @var string
     */
    protected $company;

    /**
     * @var string
     */
    protected $payAndBenefits;

    /**
     * @var string
     */
    protected $applicationInstructions;

    /**
     * @var string
     */
    protected $externalReferenceId;

    /**
     * @var string
     */
    protected $youTubeVideoKey;

    /**
     * @var ContractDuration
     */
    protected $contractDuration;

    /**
     * @var bool
     */
    protected $generalManagement;

    /**
     * @var bool
     */
    protected $workPermitRequired;

    /**
     * @var Phone
     */
    protected $phone1;

    /**
     * @var Phone
     */
    protected $phone2;

    /**
     * @var array
     */
    protected $photos = [];

    /**
     * @var int
     */
    protected $brandingBanner;

    /**
     * @var int
     */
    protected $brandingLogo;

    /**
     * @param int $id
     * @param int $category
     * @param string $title
     * @param string $shortDescription
     * @param string $description
     * @param District $jobDistrict
     * @param JobType $jobType
     * @param PayType $payType
     * @param PreferredApplicationMode $preferredApplicationMode
     * @param string $contactName
     * @throws InvalidArgumentException
     */
    public function __construct(
        $id = null,
        $category,
        $title,
        $shortDescription,
        $description,
        District $jobDistrict,
        JobType $jobType,
        PayType $payType,
        PreferredApplicationMode $preferredApplicationMode,
        $contactName
    ) {
        parent::__construct($id);
        $this->setCategory($category);
        $this->setTitle($title);
        $this->setShortDescription($shortDescription);
        $this->setDescription($description);
        $this->setJobDistrict($jobDistrict);
        $this->setJobType($jobType);
        $this->setPayType($payType);
        $this->setPreferredApplicationMode($preferredApplicationMode);
        $this->setContactName($contactName);
    }

    /**
     * @param int $category
     * @throws InvalidArgumentException
     */
    public function setCategory($category)
    {
        if (!is_int($category) || $category < 1) {
            throw new InvalidArgumentException('Category must be an integer and be greater than 0');
        }
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $title
     * @throws InvalidArgumentException
     */
    public function setTitle($title)
    {
        if (!is_string($title)) {
            throw new InvalidArgumentException('Title must be a string');
        }

        if (!$title) {
            throw new InvalidArgumentException('Title cannot be empty');
        }

        if (strlen($title) > 50) {
            throw new InvalidArgumentException('Title must be no more than 50 characters long');
        }
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $shortDescription
     * @throws InvalidArgumentException
     */
    public function setShortDescription($shortDescription)
    {
        if (!is_string($shortDescription)) {
            throw new InvalidArgumentException('Short description must be a string');
        }

        if (!$shortDescription) {
            throw new InvalidArgumentException('Short description cannot be empty');
        }

        if (strlen($shortDescription) > 150) {
            throw new InvalidArgumentException('Short description must be no more than 150 characters long');
        }
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param string $description
     * @throws InvalidArgumentException
     */
    public function setDescription($description)
    {
        if (!is_string($description)) {
            throw new InvalidArgumentException('Description must be a string');
        }

        if (!$description) {
            throw new InvalidArgumentException('Description cannot be empty');
        }

        if (strlen($description) > 2048) {
            throw new InvalidArgumentException('Description must be no more than 2048 characters long');
        }
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param District $jobDistrict
     */
    public function setJobDistrict(District $jobDistrict)
    {
        $this->jobDistrict = $jobDistrict;
    }

    /**
     * @return District
     */
    public function getJobDistrict()
    {
        return $this->jobDistrict;
    }

    /**
     * @param JobType $jobType
     */
    public function setJobType(JobType $jobType)
    {
        $this->jobType = $jobType;
    }

    /**
     * @return JobType
     */
    public function getJobType()
    {
        return $this->jobType;
    }

    /**
     * @param PayType $payType
     */
    public function setPayType(PayType $payType)
    {
        $this->payType = $payType;
    }

    /**
     * @return PayType
     */
    public function getPayType()
    {
        return $this->payType;
    }

    /**
     * @param PreferredApplicationMode $preferredApplicationMode
     */
    public function setPreferredApplicationMode(PreferredApplicationMode $preferredApplicationMode)
    {
        $this->preferredApplicationMode = $preferredApplicationMode;
    }

    /**
     * @return PreferredApplicationMode
     */
    public function getPreferredApplicationMode()
    {
        return $this->preferredApplicationMode;
    }

    /**
     * @param string $contactName
     * @throws InvalidArgumentException
     */
    public function setContactName($contactName)
    {
        if (!is_string($contactName)) {
            throw new InvalidArgumentException('Contact name must be a string');
        }

        if (!$contactName) {
            throw new InvalidArgumentException('Contact name cannot be empty');
        }

        if (strlen($contactName) > 50) {
            throw new InvalidArgumentException('Contact name must be no more than 50 characters long');
        }
        $this->contactName = $contactName;
    }

    /**
     * @return string
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * @param SalaryRange $salaryRange
     */
    public function setSalaryRange(SalaryRange $salaryRange = null)
    {
        $this->salaryRange = $salaryRange;
    }

    /**
     * @return SalaryRange
     */
    public function getSalaryRange()
    {
        return $this->salaryRange;
    }

    /**
     * @param HourlyRateRange $hourlyRateRange
     */
    public function setHourlyRateRange(HourlyRateRange $hourlyRateRange = null)
    {
        $this->hourlyRateRange = $hourlyRateRange;
    }

    /**
     * @return HourlyRateRange
     */
    public function getHourlyRateRange()
    {
        return $this->hourlyRateRange;
    }

    /**
     * @param string $emailAddress
     * @throws InvalidArgumentException
     */
    public function setEmailAddress($emailAddress)
    {
        if ($emailAddress !== null && !filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email address format is invalid');
        }

        if (strlen($emailAddress) > 50) {
            throw new InvalidArgumentException('Email address must be no more than 50 characters long');
        }

        $this->emailAddress = $emailAddress;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $applicationUrl
     * @throws InvalidArgumentException
     */
    public function setApplicationUrl($applicationUrl)
    {
        if ($applicationUrl !== null && !filter_var($applicationUrl, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Application URL format is invalid');
        }

        if (strlen($applicationUrl) > 250) {
            throw new InvalidArgumentException('Application URL must be no more than 250 characters long');
        }

        $this->applicationUrl = $applicationUrl;
    }

    /**
     * @return string
     */
    public function getApplicationUrl()
    {
        return $this->applicationUrl;
    }

    /**
     * @param string $company
     * @throws InvalidArgumentException
     */
    public function setCompany($company)
    {
        if ($company !== null && !is_string($company)) {
            throw new InvalidArgumentException('Company must be a string');
        }

        if (strlen($company) > 50) {
            throw new InvalidArgumentException('Company must be no more than 50 characters long');
        }
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $payAndBenefits
     * @throws InvalidArgumentException
     */
    public function setPayAndBenefits($payAndBenefits)
    {
        if ($payAndBenefits !== null && !is_string($payAndBenefits)) {
            throw new InvalidArgumentException('Pay and benefits must be a string');
        }

        if (strlen($payAndBenefits) > 50) {
            throw new InvalidArgumentException('Pay and benefits must be no more than 50 characters long');
        }
        $this->payAndBenefits = $payAndBenefits;
    }

    /**
     * @return string
     */
    public function getPayAndBenefits()
    {
        return $this->payAndBenefits;
    }

    /**
     * @param string $applicationInstructions
     * @throws InvalidArgumentException
     */
    public function setApplicationInstructions($applicationInstructions)
    {
        if ($applicationInstructions !== null && !is_string($applicationInstructions)) {
            throw new InvalidArgumentException('Application instructions must be a string');
        }

        if (strlen($applicationInstructions) > 500) {
            throw new InvalidArgumentException('Application instructions must be no more than 500 characters long');
        }
        $this->applicationInstructions = $applicationInstructions;
    }

    /**
     * @return string
     */
    public function getApplicationInstructions()
    {
        return $this->applicationInstructions;
    }

    /**
     * @param string $externalReferenceId
     * @throws InvalidArgumentException
     */
    public function setExternalReferenceId($externalReferenceId)
    {
        if ($externalReferenceId !== null && !is_string($externalReferenceId)) {
            throw new InvalidArgumentException('External reference id must be a string');
        }

        if (strlen($externalReferenceId) > 50) {
            throw new InvalidArgumentException('External reference id must be no more than 50 characters long');
        }
        $this->externalReferenceId = $externalReferenceId;
    }

    /**
     * @return string
     */
    public function getExternalReferenceId()
    {
        return $this->externalReferenceId;
    }

    /**
     * @param string $youTubeVideoKey
     * @throws InvalidArgumentException
     */
    public function setYouTubeVideoKey($youTubeVideoKey)
    {
        if ($youTubeVideoKey !== null && !preg_match('/^[a-zA-Z0-9_-]{11}$/', $youTubeVideoKey)) {
            throw new InvalidArgumentException('YouTube video key format is invalid');
        }
        $this->youTubeVideoKey = $youTubeVideoKey;
    }

    /**
     * @return string
     */
    public function getYouTubeVideoKey()
    {
        return $this->youTubeVideoKey;
    }

    /**
     * @param ContractDuration $contractDuration
     */
    public function setContractDuration(ContractDuration $contractDuration = null)
    {
        $this->contractDuration = $contractDuration;
    }

    /**
     * @return ContractDuration
     */
    public function getContractDuration()
    {
        return $this->contractDuration;
    }

    /**
     * @param $generalManagement
     * @throws InvalidArgumentException
     */
    public function setGeneralManagement($generalManagement)
    {
        if ($generalManagement !== null && !is_bool($generalManagement)) {
            throw new InvalidArgumentException('General management must be a boolean value');
        }
        $this->generalManagement = $generalManagement;
    }

    /**
     * @return bool
     */
    public function getGeneralManagement()
    {
        return $this->generalManagement;
    }

    /**
     * @param $workPermitRequired
     * @throws InvalidArgumentException
     */
    public function setWorkPermitRequired($workPermitRequired)
    {
        if ($workPermitRequired !== null && !is_bool($workPermitRequired)) {
            throw new InvalidArgumentException('Work permit required must be a boolean value');
        }
        $this->workPermitRequired = $workPermitRequired;
    }

    /**
     * @return bool
     */
    public function getWorkPermitRequired()
    {
        return $this->workPermitRequired;
    }

    /**
     * @param Phone $phone
     */
    public function setPhone1(Phone $phone = null)
    {
        $this->phone1 = $phone;
    }

    /**
     * @return Phone
     */
    public function getPhone1()
    {
        return $this->phone1;
    }

    /**
     * @param Phone $phone
     */
    public function setPhone2(Phone $phone = null)
    {
        $this->phone2 = $phone;
    }

    /**
     * @return Phone
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * @param int $photoId
     * @throws InvalidArgumentException
     */
    public function addPhoto($photoId)
    {
        if (!is_int($photoId)) {
            throw new InvalidArgumentException('Photo id must be an integer value');
        }
        $this->photos[$photoId] = true;
    }

    /**
     * @param int $photoId
     * @throws InvalidArgumentException
     */
    public function removePhoto($photoId)
    {
        unset($this->photos[$photoId]);
    }

    /**
     * @param array $photos
     * @throws InvalidArgumentException
     */
    public function setPhotos(array $photos)
    {
        if (!empty($photos)) {
            foreach ($photos as $photo) {
                $this->addPhoto($photo);
            }
        }
    }

    /**
     * @return array
     */
    public function getPhotos()
    {
        return array_keys($this->photos);
    }

    /**
     * @param int $brandingBanner
     * @throws InvalidArgumentException
     */
    public function setBrandingBanner($brandingBanner)
    {
        if ($brandingBanner !== null && (!is_int($brandingBanner) || $brandingBanner < 1)) {
            throw new InvalidArgumentException('Branding banner must be an integer and be greater than 0');
        }
        $this->brandingBanner = $brandingBanner;
    }

    /**
     * @return int
     */
    public function getBrandingBanner()
    {
        return $this->brandingBanner;
    }

    /**
     * @param int $brandingLogo
     * @throws InvalidArgumentException
     */
    public function setBrandingLogo($brandingLogo)
    {
        if ($brandingLogo !== null && (!is_int($brandingLogo) || $brandingLogo < 1)) {
            throw new InvalidArgumentException('Branding logo must be an integer and be greater than 0');
        }
        $this->brandingLogo = $brandingLogo;
    }

    /**
     * @return int
     */
    public function getBrandingLogo()
    {
        return $this->brandingLogo;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        $attributes = [
            [
                'Name'  => 'JobDistrict',
                'Value' => $this->getJobDistrict()->getValue(),
            ],
            [
                'Name'  => 'JobType',
                'Value' => $this->getJobType()->getValue(),
            ],
            [
                'Name'  => 'PayType',
                'Value' => $this->getPayType()->getValue(),
            ],
            [
                'Name'  => 'PreferredApplicationMode',
                'Value' => $this->getPreferredApplicationMode()->getValue(),
            ],
            [
                'Name'  => 'ContactName',
                'Value' => $this->getContactName(),
            ],
            [
                'Name'  => 'EmailAddress',
                'Value' => $this->getEmailAddress(),
            ],
            [
                'Name'  => 'ApplicationUrl',
                'Value' => $this->getApplicationUrl(),
            ],
            [
                'Name'  => 'Company',
                'Value' => $this->getCompany(),
            ],
            [
                'Name'  => 'PayAndBenefits',
                'Value' => $this->getPayAndBenefits(),
            ],
            [
                'Name'  => 'ApplicationInstructions',
                'Value' => $this->getApplicationInstructions(),
            ],
            [
                'Name'  => 'ContractDuration',
                'Value' => 'PER',
            ],
        ];

        $salaryRange = $this->getSalaryRange();
        if ($salaryRange !== null) {
            $attributes = array_merge($attributes, $salaryRange->getArray());
        }

        $hourlyRateRange = $this->getHourlyRateRange();
        if ($hourlyRateRange !== null) {
            $attributes = array_merge($attributes, $hourlyRateRange->getArray());
        }

        $phone1 = $this->getPhone1();
        if ($phone1 !== null) {
            $attributes[] = [
                'Name'  => 'Phone1Prefix',
                'Value' => $phone1->getPrefix(),
            ];
            $attributes[] = [
                'Name'  => 'Phone1Number',
                'Value' => $phone1->getPhone(),
            ];
        }

        $phone2 = $this->getPhone2();
        if ($phone2 !== null) {
            $attributes[] = [
                'Name'  => 'Phone2Prefix',
                'Value' => $phone2->getPrefix(),
            ];
            $attributes[] = [
                'Name'  => 'Phone2Number',
                'Value' => $phone2->getPhone(),
            ];
        }

        $brandingBanner = $this->getBrandingBanner();
        $brandingLogo = $this->getBrandingLogo();
        $isBranded = false;
        if ($brandingBanner !== null || $brandingLogo !== null) {
            $isBranded = true;
            $attributes[] = [
                'Name'  => 'Branding',
                'Value' => true,
            ];
            $attributes[] = [
                'Name'  => 'BrandingBanner',
                'Value' => $brandingBanner,
            ];
            $attributes[] = [
                'Name'  => 'BrandingLogo',
                'Value' => $brandingLogo,
            ];
        }

        return [
            'ListingId'            => $this->getId(),
            'Category'             => $this->getCategory(),
            'Title'                => $this->getTitle(),
            'ShortDescription'     => $this->getShortDescription(),
            'Description'          => [
                $this->getDescription(),
            ],
            'Duration'             => $this->duration,
            'ExternalReferenceId'  => $this->getExternalReferenceId(),
            'EmbeddedContent'      => [
                'YouTubeVideoKey' => $this->getYouTubeVideoKey(),
            ],
            'IsBranded'            => $isBranded,
            'IsClassified'         => true,
            'ReturnListingDetails' => false,
            'PhotoIds'             => $this->getPhotos(),
            'Attributes'           => $attributes,
        ];
    }
}
