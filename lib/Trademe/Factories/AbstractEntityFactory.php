<?php namespace Trademe\Factories;

use Trademe\Entities\Entity;

/**
 * Abstract factory
 */
class AbstractEntityFactory
{
    /**
     * @param Entity $entity
     * @param array $data
     * @param array $mappings
     */
    public static function populateEntity(Entity &$entity, array $data, array $mappings)
    {
        foreach ($mappings as $fieldName => $attributes) {
            if (array_key_exists($fieldName, $data)) {
                $function = $attributes['function'];
                if (isset($attributes['type'])) {
                    $enum = $attributes['type'];
                    $value = $enum::get($data[$fieldName]);
                } else {
                    $value = $data[$fieldName];
                }
                $entity->$function($value);
            }
        }
    }
}
