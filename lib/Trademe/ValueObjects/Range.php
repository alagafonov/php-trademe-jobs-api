<?php namespace Trademe\ValueObjects;

use Trademe\Exceptions\InvalidArgumentException;

/**
 * Abstract class range
 */
abstract class Range implements ValueObjectInterface
{
    /**
     * @var int
     */
    protected $min;

    /**
     * @var int
     */
    protected $max;

    /**
     * @param $min
     * @param $max
     * @throws InvalidArgumentException
     */
    public function __construct($min, $max)
    {
        if (!is_int($min)) {
            throw new InvalidArgumentException(
                'Minimum value must be an integer'
            );
        }

        if (!is_int($max)) {
            throw new InvalidArgumentException(
                'Maximum value must be an integer'
            );
        }

        if ($min > $max) {
            throw new InvalidArgumentException(
                'Minimum value cannot be greater than maximum'
            );
        }
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }
}
