<?php namespace Trademe\Entities;

/**
 * Entity interface entity
 */
interface EntityInterface
{
    public function setId($id);

    public function getId();

    public function getArray();
}
