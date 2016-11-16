<?php namespace Trademe\Tests\Data;

class Listing
{
    public static $data = [
        'ListingId'            => '5030919',
        'Category'             => 5073,
        'Title'                => 'Job Title',
        'ShortDescription'     => 'Job listing short description',
        'Description'          => [
            'Description of listing',
        ],
        'Duration'             => 7,
        'ExternalReferenceId'  => 'SHRID111',
        'EmbeddedContent'      => [
            'YouTubeVideoKey' => 'o25IVDIwiAE',
        ],
        'IsBranded'            => true,
        'IsClassified'         => true,
        'ReturnListingDetails' => true,
        'PhotoIds'             => [
            987654321,
            765432100,
        ],
        'Attributes'           =>
            [
                [
                    'Name'  => 'JobDistrict',
                    'Value' => 32,
                ],
                [
                    'Name'  => 'JobType',
                    'Value' => 'FT',
                ],
                [
                    'Name'  => 'PayType',
                    'Value' => 'Salary',
                ],
                [
                    'Name'  => 'PreferredApplicationMode',
                    'Value' => 'O',
                ],
                [
                    'Name'  => 'ContactName',
                    'Value' => 'Joe Smithqwe',
                ],
                [
                    'Name'  => 'ApproximatePay',
                    'Value' => 10000,
                ],
                [
                    'Name'  => 'ApproximatePayRangeHigh',
                    'Value' => 30000,
                ],
                [
                    'Name'  => 'HourlyRateRangeLower',
                    'Value' => 0,
                ],
                [
                    'Name'  => 'HourlyRateRangeUpper',
                    'Value' => 400,
                ],
                [
                    'Name'  => 'EmailAddress',
                    'Value' => 'example@example.org',
                ],
                [
                    'Name'  => 'ApplicationUrl',
                    'Value' => 'http://www.subscribe-hr.com.au/test/1/2/3',
                ],
                [
                    'Name'  => 'Phone1Prefix',
                    'Value' => '61',
                ],
                [
                    'Name'  => 'Phone1Number',
                    'Value' => '1234567',
                ],
                [
                    'Name'  => 'Phone2Prefix',
                    'Value' => 61,
                ],
                [
                    'Name'  => 'Phone2Number',
                    'Value' => '1234568',
                ],
                [
                    'Name'  => 'Company',
                    'Value' => 'Acme Inc.',
                ],
                [
                    'Name'  => 'PayAndBenefits',
                    'Value' => 'The pay and benefits of the job',
                ],
                [
                    'Name'  => 'ApplicationInstructions',
                    'Value' => 'Instructions on how to apply',
                ],
                [
                    'Name'  => 'ContractDuration',
                    'Value' => 'PER',
                ],
                /*[
                    'Name'  => 'Branding',
                    'Value' => true,
                ],
                [
                    'Name'  => 'BrandingBanner',
                    'Value' => 345678,
                ],
                [
                    'Name'  => 'BrandingLogo',
                    'Value' => 345679,
                ],*/
            ],
    ];
}
