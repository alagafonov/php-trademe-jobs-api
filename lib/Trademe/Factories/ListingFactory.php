<?php namespace Trademe\Factories;

/**
 * Listing factory
 */
class ListingFactory extends AbstractEntityFactory
{
    private static $mappings = [
        'Category'            => [
            'function' => 'setCategory',
        ],
        'Title'               => [
            'function' => 'setTitle',
        ],
        'ShortDescription'    => [
            'function' => 'setShortDescription',
        ],
        'Duration'            => [
            'function' => 'setDuration',
        ],
        'ExternalReferenceId' => [
            'function' => 'setExternalReferenceId',
        ],
        'PhotoIds'            => [
            'function' => 'addPhoto',
            'type'     => 'array',
        ],
    ];

    public static function createListing(array $data)
    {


    }

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
                        $result[$attribute['Name']] = $fieldValue;
                    }
                }
            }

            if ($fieldName != 'Attributes') {
                $result[$fieldName] = $fieldValue;
            }
        }

    }

}
