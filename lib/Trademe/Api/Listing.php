<?php namespace Trademe\Api;

use Trademe\Entities\Listing as ListingEntity;
use Trademe\Factories\ListingFactory;

/**
 * Listing end point
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

    /**
     * @param ListingEntity $listing
     * @return mixed
     */
    public function create(ListingEntity $listing)
    {
        return $this->post('/Selling.json', $listing->getArray());
    }

    /**
     * @param ListingEntity $listing
     * @return mixed
     */
    public function update(ListingEntity $listing)
    {
        return $this->post('/Selling/Edit.json', $listing->getArray());
    }

    /**
     * @param ListingEntity $listing
     * @return mixed
     */
    public function validate(ListingEntity $listing)
    {
        return $this->post('/Selling/Validate.json', $listing->getArray());
    }

    /**
     * @param int $listingId
     * @return mixed
     */
    public function relist($listingId)
    {
        return $this->post(
            '/Selling/Relist.json',
            [
                'ListingId'            => $listingId,
                'ReturnListingDetails' => false,
            ]
        );
    }

    /**
     * Note: Currently, this can use a similar payload to edit, what response of the Retrieve a job listing endpoint.
     * However, this is not guaranteed in the future.
     *
     * @param ListingEntity $listing
     * @return mixed
     */
    public function relistWithEdits(ListingEntity $listing)
    {
        return $this->post('/Selling/RelistWithEdits.json', $listing->getArray());
    }

    /**
     * @param int $listingId
     * @return mixed
     */
    public function duplicate($listingId)
    {
        return $this->post(
            '/Selling/Similar.json',
            [
                'ListingId'            => $listingId,
                'ReturnListingDetails' => false,
            ]
        );
    }

    /**
     * @param int $listingId
     * @param boolean $positionFilled
     * @return mixed
     */
    public function withdraw($listingId, $positionFilled)
    {
        if ($positionFilled) {
            $type = 'ListingWasSold';
            $reason = 'Position filled';
        } else {
            $type = 'ListingWasNotSold';
            $reason = 'Position was not filled';
        }

        return $this->post(
            '/Selling/Withdraw.json',
            [
                'ListingId'            => $listingId,
                'Type'                 => $type,
                'Reason'               => $reason,
                'ReturnListingDetails' => false,
            ]
        );
    }
}
