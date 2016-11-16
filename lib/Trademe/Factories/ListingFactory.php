<?php namespace Trademe\Factories;

use Trademe\Entities\HourlyRateRange;
use Trademe\Entities\Listing;
use Trademe\Entities\Phone;
use Trademe\Entities\SalaryRange;
use Trademe\Enums\District;
use Trademe\Enums\JobType;
use Trademe\Enums\PayType;
use Trademe\Enums\PreferredApplicationMode;

/**
 * Listing factory
 */
class ListingFactory extends AbstractEntityFactory
{
    /**
     * @var array
     */
    private static $mappings = [
        'Company'                 => [
            'function' => 'setCompany',
        ],
        'PayAndBenefits'          => [
            'function' => 'setPayAndBenefits',
        ],
        'ApplicationInstructions' => [
            'function' => 'setApplicationInstructions',
        ],
        'ContractDuration'        => [
            'function' => 'setContractDuration',
            'type'    => 'ContractDuration',
        ],
        'ApplicationUrl'          => [
            'function' => 'setApplicationUrl',
        ],
        'EmailAddress'            => [
            'function' => 'setEmailAddress',
        ],
        'ContactName'             => [
            'function' => 'setContactName',
        ],
        'YouTubeVideoKey'         => [
            'function' => 'setYouTubeVideoKey',
        ],
        'ExternalReferenceId'     => [
            'function' => 'setExternalReferenceId',
        ],
        'PhotoIds'                => [
            'function' => 'setPhotos',
        ],
    ];

    /**
     * @param array $data
     * @return Listing
     */
    public static function createListingFromArray(array $data)
    {
        $listing = new Listing(
            $data['ListingId'],
            self::getCategory($data['Category']),
            $data['Title'],
            $data['ShortDescription'],
            $data['Description'],
            District::get($data['JobDistrict']),
            JobType::get($data['JobType']),
            PayType::get($data['PayType']),
            PreferredApplicationMode::get($data['PreferredApplicationMode'])
        );
        parent::populateEntity($listing, $data, self::$mappings);

        if (isset($data['ApproximatePay']) && isset($data['ApproximatePayRangeHigh'])) {
            $listing->setSalaryRange(new SalaryRange($data['ApproximatePay'], $data['ApproximatePayRangeHigh']));
        }

        if (isset($data['HourlyRateRangeLower']) && isset($data['HourlyRateRangeUpper'])) {
            $listing->setHourlyRateRange(
                new HourlyRateRange($data['HourlyRateRangeLower'], $data['HourlyRateRangeUpper'])
            );
        }

        if (isset($data['Phone1Prefix']) && isset($data['Phone1Number'])) {
            $listing->setPhone1(
                new Phone($data['Phone1Prefix'], $data['Phone1Number'])
            );
        }

        if (isset($data['Phone2Prefix']) && isset($data['Phone2Number'])) {
            $listing->setPhone2(
                new Phone($data['Phone2Prefix'], $data['Phone2Number'])
            );
        }

        return $listing;
    }

    /**
     * @param array $data
     * @return array
     */
    public static function transformArray(array $data)
    {
        $result = [];
        foreach ($data as $fieldName => $fieldValue) {
            if ($fieldName == 'Description') {
                $fieldValue = isset($fieldValue[0]) ? $fieldValue[0] : '';
            } elseif ($fieldName == 'EmbeddedContent') {
                $fieldName = 'YouTubeVideoKey';
                $fieldValue = isset($fieldValue['YouTubeVideoKey']) ? $fieldValue['YouTubeVideoKey'] : '';
            } elseif ($fieldName == 'Attributes') {
                if (!empty($fieldValue)) {
                    foreach ($fieldValue as $attribute) {
                        $result[$attribute['Name']] = $attribute['Value'];
                    }
                }
            }

            if ($fieldName != 'Attributes') {
                $result[$fieldName] = $fieldValue;
            }
        }
        return $result;
    }
}
