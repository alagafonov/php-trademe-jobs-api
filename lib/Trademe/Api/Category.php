<?php namespace Trademe\Api;

/**
 * Category end point.
 */
class Category extends ApiAbstract
{
    public function all()
    {
        return $this->get('/Categories/Jobs.json');
    }

    public function details($code)
    {
        return $this->get('/Categories/' . $code . '/Details.json');
    }
}
