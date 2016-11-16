<?php namespace Trademe\Entities;

use Trademe\Exceptions\InvalidArgumentException;

/**
 * Entity abstract class
 */
abstract class Entity implements EntityInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @param int $id
     * @throws InvalidArgumentException
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return [
            'id' => $this->id,
        ];
    }
}
