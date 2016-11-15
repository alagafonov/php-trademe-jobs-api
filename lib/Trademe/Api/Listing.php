<?php namespace Trademe\Api;

/**
 * Locality end point.
 */
class Listing extends ApiAbstract
{
    public function getOne($listingId)
    {
        return $this->get('/Selling/Listings/' . $listingId . '.json');
    }

    public function validate(array $data)
    {
        return $this->post('/Selling/Validate.json', $data);
    }
}
