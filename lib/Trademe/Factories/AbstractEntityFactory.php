<?php namespace Trademe\Factories;

use Trademe\Entities\Listing;
use Trademe\Entities\EntityInterface;
use Trademe\Enums\ContractDuration;
use Trademe\Enums\JobType;
use Trademe\Enums\PayType;
use Trademe\Enums\PreferredApplicationMode;
use Trademe\Exceptions\InvalidArgumentException;

/**
 * Abstract factory
 */
class AbstractEntityFactory
{
    public static function createEntity(EntityInterface $entity, array $data, array $mappings)
    {

    }
}
