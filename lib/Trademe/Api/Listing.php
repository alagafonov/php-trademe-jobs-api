<?php namespace Trademe\Api;

use Trademe\Entities\Listing as ListingEntity;
use Trademe\Factories\ListingFactory;

/**
 * Locality end point.
 */
class Listing extends ApiAbstract
{
    /**
     * @param int $listingId
     * @return ListingEntity
     */
    public function retrieve($listingId)
    {
        return ListingFactory::createListingFromArray(
            ListingFactory::transformArray($this->get('/Selling/Listings/' . $listingId . '.json'))
        );
    }

    public function create(array $data)
    {
        return $this->post('/Selling.json', $data);
    }

    public function update(array $data)
    {
        return $this->post('/Selling/Edit.json', $data);
    }

    public function validate(ListingEntity $listing)
    {
        return $this->post('/Selling/Validate.json', $listing->getArray());
    }

    public function relist(array $data)
    {
        return $this->post('/Selling/Relist.json', $data);
    }

    public function relistWithEdits(ListingEntity $listing)
    {
        return $this->post('/Selling/RelistWithEdits.json', $listing->getArray());
    }

    public function duplicate(array $data)
    {
        return $this->post('/Selling/Similar.json', $data);
    }

    public function withdraw(array $data)
    {
        return $this->post('/Selling/Withdraw.json', $data);
    }
}
