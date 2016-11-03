<?php namespace Trademe\Api;

/**
 * Locality end point.
 */
class Locality extends ApiAbstract
{
    public function all()
    {
        return $this->get('/Localities.json');
    }
}
