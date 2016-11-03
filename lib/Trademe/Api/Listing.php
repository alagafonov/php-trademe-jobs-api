<?php namespace Trademe\Api;

/**
 * Locality end point.
 */
class Listing extends ApiAbstract
{
    public function get($listingId)
    {
        return $this->get('/Listings/' . $listingId . '.json');
    }

    public function validate(array $data)
    {
        return $this->post('/Selling.json', $data);
    }
}
