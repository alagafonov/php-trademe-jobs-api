<?php namespace Trademe\Factories;

use Trademe\Entities\EntityInterface;

/**
 * Abstract factory
 */
class AbstractEntityFactory
{
    /**
     * @param EntityInterface $entity
     * @param array $data
     * @param array $mappings
     */
    public static function populateEntity(EntityInterface &$entity, array $data, array $mappings)
    {
        foreach ($mappings as $fieldName => $attributes) {
            if (array_key_exists($fieldName, $data)) {
                $function = $attributes['function'];
                if (isset($attributes['type'])) {
                    $enum = $attributes['class'];
                    $value = $enum::get($data[$fieldName]);
                } else {
                    $value = $data[$fieldName];
                }
                $entity->$function($value);
            }
        }
    }
}
